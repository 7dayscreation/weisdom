const fs = require('fs');
const path = require('path');

const ROOT_DIR = path.resolve(__dirname, '..');

// Target directories for image scanning (covers all assets and future projects)
const TARGET_DIRS = [
  path.join(ROOT_DIR, 'assets'),
  path.join(ROOT_DIR, 'projects')
];

// Files / names to exclude from conversion
const EXCLUDE_NAMES = ['favicon.png', 'favicon.ico'];

// Recursive file scanner for images
function getImagesRecursively(dir, fileList = []) {
  if (!fs.existsSync(dir)) return fileList;

  const files = fs.readdirSync(dir);
  files.forEach(file => {
    // Skip node_modules, git, backups, scripts
    if (['node_modules', '.git', '_php_backup', 'scratch', 'scripts'].includes(file)) return;

    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);

    if (stat.isDirectory()) {
      getImagesRecursively(filePath, fileList);
    } else {
      const ext = path.extname(file).toLowerCase();
      const baseName = path.basename(file).toLowerCase();

      if (['.jpg', '.jpeg', '.png'].includes(ext) && !EXCLUDE_NAMES.includes(baseName)) {
        fileList.push(filePath);
      }
    }
  });

  return fileList;
}

// Recursive code file scanner
function getCodeFilesRecursively(dir, fileList = []) {
  if (!fs.existsSync(dir)) return fileList;

  const files = fs.readdirSync(dir);
  files.forEach(file => {
    if (['node_modules', '.git', '_php_backup', 'scratch', 'scripts', '.github'].includes(file)) return;

    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);

    if (stat.isDirectory()) {
      getCodeFilesRecursively(filePath, fileList);
    } else {
      const ext = path.extname(file).toLowerCase();
      if (['.html', '.js', '.json', '.css'].includes(ext)) {
        fileList.push(filePath);
      }
    }
  });

  return fileList;
}

async function run() {
  console.log('====================================================');
  console.log('🌟 Weisdom Design Build — Auto Image Optimizer (WebP) 🌟');
  console.log('====================================================\n');

  // Load sharp (with fallback to sibling projects if running locally)
  let sharp;
  try {
    sharp = require('sharp');
  } catch (err) {
    try {
      sharp = require(path.join(ROOT_DIR, '..', '7dayscreation', 'node_modules', 'sharp'));
    } catch (e) {
      console.error("❌ Error: The 'sharp' library is not installed.");
      console.error('Please run: npm install sharp\n');
      process.exit(1);
    }
  }

  console.log('🔍 Scanning target directories for JPG and PNG images...');
  let allImages = [];
  TARGET_DIRS.forEach(dir => {
    if (fs.existsSync(dir)) {
      const found = getImagesRecursively(dir);
      console.log(`  📂 ${path.relative(ROOT_DIR, dir)}: Found ${found.length} images`);
      allImages = allImages.concat(found);
    }
  });

  if (allImages.length === 0) {
    console.log('\n✅ No JPG/PNG images found. Everything is already clean!\n');
    return;
  }

  console.log(`\n📸 Total source images found: ${allImages.length}`);
  console.log('⚙️ Starting high-efficiency conversion to WebP...\n');

  let convertCount = 0;
  let skipCount = 0;
  let bytesBefore = 0;
  let bytesAfter = 0;

  for (const filePath of allImages) {
    const relativePath = path.relative(ROOT_DIR, filePath);
    const ext = path.extname(filePath);
    const webpPath = filePath.replace(new RegExp(`${ext.replace('.', '\\.')}$`, 'i'), '.webp');

    const sourceStat = fs.statSync(filePath);
    bytesBefore += sourceStat.size;

    // Check if WebP already exists and is newer than source
    if (fs.existsSync(webpPath)) {
      const webpStat = fs.statSync(webpPath);
      if (webpStat.mtime >= sourceStat.mtime && webpStat.size > 0) {
        bytesAfter += webpStat.size;
        skipCount++;
        continue;
      }
    }

    try {
      const info = await sharp(filePath)
        .webp({ quality: 82, effort: 4 })
        .toFile(webpPath);

      bytesAfter += info.size;
      const savedPercent = ((1 - info.size / sourceStat.size) * 100).toFixed(1);
      console.log(`  ⚡ Converted: ${relativePath} ➔ .webp (${(sourceStat.size / 1024).toFixed(0)}KB ➔ ${(info.size / 1024).toFixed(0)}KB, -${savedPercent}%)`);
      convertCount++;
    } catch (err) {
      bytesAfter += sourceStat.size;
      console.error(`  ❌ Failed to convert ${relativePath}:`, err.message);
    }
  }

  const savedMb = ((bytesBefore - bytesAfter) / (1024 * 1024)).toFixed(2);
  const totalMbBefore = (bytesBefore / (1024 * 1024)).toFixed(2);
  const totalMbAfter = (bytesAfter / (1024 * 1024)).toFixed(2);

  console.log('\n📊 Conversion Summary:');
  console.log(`  ✨ Newly Converted: ${convertCount}`);
  console.log(`  ⏭️  Already Optimized & Skipped: ${skipCount}`);
  console.log(`  💾 Total Size: ${totalMbBefore} MB ➔ ${totalMbAfter} MB`);
  console.log(`  🎉 Net Data Saved: ${savedMb} MB (${((1 - bytesAfter / bytesBefore) * 100).toFixed(1)}% reduction!)\n`);

  // Auto-Update Code References in HTML, JS, JSON, CSS
  console.log('🔗 Scanning codebase to update image extensions to .webp & add lazy loading...');
  const codeFiles = getCodeFilesRecursively(ROOT_DIR);
  let refUpdateCount = 0;

  codeFiles.forEach(file => {
    const relativePath = path.relative(ROOT_DIR, file);
    try {
      let content = fs.readFileSync(file, 'utf8');
      const originalContent = content;

      // Replace .jpg, .jpeg, .png with .webp for site assets
      // Excludes favicon.png, external http/https urls, and data uris
      content = content.replace(/(["'\(])(?!\/\/|https?:\/\/|data:)([^"'()\s]+?)\.(png|jpg|jpeg)(["'\)])/gi, (match, prefix, imgPath, ext, suffix) => {
        if (imgPath.toLowerCase().includes('favicon')) {
          return match;
        }
        return `${prefix}${imgPath}.webp${suffix}`;
      });

      // Add loading="lazy" decoding="async" to <img> tags in HTML if missing (exclude logos and hero images)
      if (file.endsWith('.html')) {
        content = content.replace(/<img\s+(?![^>]*\bloading=)([^>]+)>/gi, (match, attrs) => {
          // If it's a logo or hero above-the-fold image, do not lazy load
          if (attrs.includes('id="dark-logo"') || attrs.includes('id="light-logo"') || attrs.includes('class="logo"') || attrs.includes('data-no-lazy')) {
            return match;
          }
          return `<img loading="lazy" decoding="async" ${attrs}>`;
        });
      }

      if (content !== originalContent) {
        fs.writeFileSync(file, content, 'utf8');
        console.log(`  📝 References Updated: ${relativePath}`);
        refUpdateCount++;
      }
    } catch (err) {
      console.error(`  ❌ Failed to update references in ${relativePath}:`, err.message);
    }
  });

  console.log(`\n🔗 Reference Update Summary:`);
  console.log(`  📝 Files updated with .webp & lazy loading: ${refUpdateCount}`);
  console.log('\n🎉 Optimization complete! Site is now ultra-fast.');
}

run().catch(console.error);
