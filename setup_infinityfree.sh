#!/bin/bash

# Acnoo Pharmacy - InfinityFree Setup Script
# This script helps prepare the Laravel files for InfinityFree hosting

echo "🚀 Acnoo Pharmacy - InfinityFree Setup Script"
echo "=============================================="

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Please run this script from the Super-Admin directory"
    exit 1
fi

echo "📋 Step 1: Creating .env file..."

# Create .env file template
cat > .env << 'EOF'
APP_NAME="Acnoo Pharmacy"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://YOUR_DOMAIN.infinityfreeapp.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=sql.infinityfree.com
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
EOF

echo "✅ .env file created"
echo ""
echo "📝 Please update the .env file with your actual values:"
echo "   - Replace YOUR_DOMAIN with your InfinityFree domain"
echo "   - Replace YOUR_DATABASE_NAME with your database name"
echo "   - Replace YOUR_DATABASE_USERNAME with your database username"
echo "   - Replace YOUR_DATABASE_PASSWORD with your database password"
echo ""

echo "📦 Step 2: Creating deployment package..."

# Create deployment directory
mkdir -p ../deployment
cd ..

# Copy Super-Admin files (excluding vendor and node_modules)
rsync -av --exclude='vendor/' --exclude='node_modules/' --exclude='.git/' --exclude='storage/logs/*' --exclude='storage/framework/cache/*' --exclude='storage/framework/sessions/*' --exclude='storage/framework/views/*' Super-Admin/ deployment/

echo "✅ Deployment package created in ../deployment/"
echo ""

echo "📋 Step 3: Creating upload instructions..."

cat > deployment/UPLOAD_INSTRUCTIONS.txt << 'EOF'
INFINITYFREE UPLOAD INSTRUCTIONS
================================

1. Login to your InfinityFree dashboard
2. Go to File Manager
3. Navigate to htdocs directory
4. Upload all files from this folder
5. Extract if needed
6. Set permissions:
   - Folders: 755
   - Files: 644
   - storage folder: 777 (recursive)

AFTER UPLOAD:
1. Access your domain
2. Run: php artisan key:generate
3. Run: php artisan migrate
4. Run: php artisan storage:link

DEFAULT LOGIN:
- Email: admin@gmail.com
- Password: password

IMPORTANT: Change the default password after first login!
EOF

echo "✅ Upload instructions created"
echo ""

echo "🎯 Step 4: Flutter app configuration reminder..."
echo ""
echo "Don't forget to update the API base URL in your Flutter app:"
echo "File: pharmacy-store-app-codecanyon-main/lib/Screens/Sales/test_repo.dart"
echo "Change: https://acnoopharmacy.acnoo.com/api/v1"
echo "To: https://YOUR_DOMAIN.infinityfreeapp.com/api/v1"
echo ""

echo "📱 Step 5: APK build reminder..."
echo ""
echo "To build the APK, run these commands:"
echo "cd pharmacy-store-app-codecanyon-main"
echo "flutter pub get"
echo "flutter build apk --release"
echo ""

echo "✅ Setup complete! Check the deployment folder for files to upload."
echo ""
echo "📚 Next steps:"
echo "1. Update .env file with your credentials"
echo "2. Upload files to InfinityFree"
echo "3. Update Flutter app API URL"
echo "4. Build APK"
echo "5. Test both admin panel and mobile app" 