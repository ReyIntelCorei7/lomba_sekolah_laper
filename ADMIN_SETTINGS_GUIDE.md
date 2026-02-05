# Admin Website Settings Guide

## Overview
The SMK Metland School website now has a comprehensive admin panel that allows you to edit all content on the homepage through a web interface. No more hardcoded content!

## How to Access Admin Settings

1. **Login to Admin Panel**
   - Go to: `http://your-domain.com/admin/login`
   - Use your admin credentials (email and password)

2. **Navigate to Settings**
   - After login, go to: `http://your-domain.com/admin/settings`
   - Or click "Website Settings" in the admin sidebar

## Available Settings Groups

### 1. General Settings
- **Site Name**: The main name of your school
- **Site Description**: Brief description shown in footer
- **School Logo**: Upload your school logo (used in header, hero, and footer)

### 2. Contact Settings
- **Contact Phone**: Main phone number
- **Contact Email**: Main email address
- **School Address**: Complete school address

### 3. Hero Section Settings
- **Hero Title**: Main title on homepage
- **Hero Subtitle**: Subtitle text
- **Hero Description**: Description text (if needed)
- **Hero Images**: Upload 3 images for the hero slider
  - Hero Image 1, 2, 3 (will rotate automatically)

### 4. About Section Settings
- **About Title**: Title for the about section
- **About Description**: Description text for about section

### 5. Statistics Settings
- **Total Students**: Number of students (animated counter)
- **Total Teachers**: Number of teachers (animated counter)
- **Total Staff**: Number of staff (animated counter)

### 6. Programs Section Settings
- **Program Section Title**: Title for programs section
- **Program Section Description**: Description for programs section

### 7. News Section Settings
- **News Section Title**: Title for news section
- **News Section Description**: Description for news section

### 8. PPDB Settings
- **PPDB Open**: Enable/disable PPDB registration
- **PPDB Start Date**: When registration opens
- **PPDB End Date**: When registration closes

### 9. Social Media Settings
- **Facebook URL**: Link to Facebook page
- **Instagram URL**: Link to Instagram profile
- **YouTube URL**: Link to YouTube channel
- **WhatsApp Number**: WhatsApp contact number

## How to Update Settings

1. **Text Settings**: Simply type in the text field
2. **Image Settings**: 
   - Click "Choose File" to upload new image
   - Supported formats: JPG, PNG, GIF
   - Images are automatically resized and optimized
3. **Boolean Settings**: Check/uncheck the checkbox
4. **Date Settings**: Use the date picker

## Important Notes

- **Always click "Save Settings"** after making changes
- **Image uploads**: New images will replace old ones
- **Backup**: Consider backing up your database before major changes
- **Cache**: Changes appear immediately, no cache clearing needed

## Troubleshooting

### Images Not Showing
- Check file permissions on `storage/app/public/settings/` folder
- Ensure `php artisan storage:link` has been run
- Verify image file formats are supported (JPG, PNG, GIF)

### Settings Not Saving
- Check database connection
- Verify admin permissions
- Check server error logs

### Homepage Not Updating
- Clear browser cache
- Check if settings were actually saved in admin panel
- Verify no syntax errors in the settings values

## Technical Details

- Settings are stored in `website_settings` database table
- Images are stored in `storage/app/public/settings/` folder
- Settings are cached for performance
- All settings have fallback default values

## Support

If you encounter any issues:
1. Check the Laravel logs in `storage/logs/laravel.log`
2. Verify database connectivity
3. Ensure proper file permissions
4. Contact your developer for technical support

---

**Last Updated**: February 2026
**Version**: 1.0