# OTP Password Reset System Documentation

## Overview
Complete OTP-based password reset system for MOIST Faculty Evaluation System that replaces unreliable email link system with secure 6-digit OTP codes sent to Gmail.

## System Flow
```
1. User enters email → System sends 6-digit OTP to Gmail (15-minute expiry)
2. User enters OTP code → System verifies and allows password reset  
3. User creates new password + confirmation → System updates password securely
```

## Files Created/Modified

### 1. **verify_otp.php** - OTP Verification Page
**Purpose**: Where users enter the 6-digit OTP code received from Gmail
**Location**: `c:\xampp\htdocs\eval\verify_otp.php`
**URL**: `localhost/eval/index.php?page=verify_otp&email=user@gmail.com`

**Key Features**:
- Large OTP input field (6 digits only)
- Auto-focus on input field
- Numbers-only validation
- Resend OTP functionality
- Clean UI matching system design

**CSS Classes**:
```css
.otp-verification-box - Main container
.otp-input - Large centered input for OTP
.resend-otp - Resend OTP link
```

**JavaScript Functions**:
```javascript
// OTP verification AJAX call
$('#verify-otp-form').submit() - Verifies OTP with backend
$('#resend-otp').click() - Resends new OTP code
```

### 2. **new_password.php** - New Password Interface  
**Purpose**: Where users create new password + confirm password
**Location**: `c:\xampp\htdocs\eval\new_password.php`
**URL**: `localhost/eval/index.php?page=new_password&email=user@gmail.com`

**Key Features**:
- Real-time password strength validation
- Password confirmation matching
- Current password duplicate prevention
- Password requirements display
- Visual strength indicator

**Password Requirements**:
- At least 8 characters long
- Contains uppercase letter (A-Z)
- Contains lowercase letter (a-z)  
- Contains at least one number (0-9)

**CSS Classes**:
```css
.new-password-box - Main container
.password-requirements - Requirements display
.password-strength - Strength indicator bar
.strength-weak/.strength-medium/.strength-strong - Strength colors
```

**JavaScript Functions**:
```javascript
checkPasswordStrength(password) - Returns strength score (0-5)
$('#new_password').on('input') - Real-time strength checking
$('#confirm_password').on('input') - Real-time confirmation matching
```

### 3. **forgot_password_otp.php** - Backend Handler
**Purpose**: Handles OTP generation, verification, and password reset
**Location**: `c:\xampp\htdocs\eval\forgot_password_otp.php`

**Functions**:
```php
send_otp() - Generates and sends 6-digit OTP via email
verify_otp() - Validates OTP code and creates verification token
reset_password() - Updates password after OTP verification
send_otp_email() - PHPMailer integration for OTP delivery
```

**Response Codes**:
- `1` = Success
- `2` = Email not found / Invalid OTP
- `3` = Email sending failed / Password too short
- `4` = Too many attempts / Password complexity issue
- `5` = New password same as current password

**Security Features**:
- 15-minute OTP expiration
- Rate limiting (MAX_RESET_ATTEMPTS_PER_HOUR)
- Secure password hashing (PASSWORD_DEFAULT)
- Current password duplicate prevention

### 4. **forgot_password.php** - Updated Entry Point
**Purpose**: Modified to use OTP flow instead of email links
**Location**: `c:\xampp\htdocs\eval\forgot_password.php`

**Changes Made**:
- Updated text: "Send OTP Code" instead of "Send Reset Link"
- AJAX calls `forgot_password_otp.php` instead of `forgot_password_handler.php`
- Redirects to `verify_otp` page after successful OTP send

### 5. **index.php** - Public Pages Configuration
**Purpose**: Added OTP pages to public access list
**Location**: `c:\xampp\htdocs\eval\index.php`

**Change Made**:
```php
// Before
$public_pages = array('login', 'forgot_password', 'reset_password');

// After  
$public_pages = array('login', 'forgot_password', 'reset_password', 'verify_otp', 'new_password');
```

## Database Integration

### Tables Used:
- **users** - Main user table with password field
- **password_reset_attempts** - Rate limiting table

### Database Fields:
```sql
users.reset_token - Stores OTP code or verification token
users.reset_expires - OTP expiration timestamp  
users.password - Hashed password (bcrypt)
users.email - User email for OTP delivery
```

## Email Configuration

### Required Files:
- `email_config_forgot.php` - SMTP configuration
- `vendor/autoload.php` - PHPMailer dependencies

### SMTP Settings:
```php
SMTP_HOST - Email server host
SMTP_USERNAME - Email account username  
SMTP_PASSWORD - Email account password
SMTP_ENCRYPTION - TLS encryption
SMTP_PORT - SMTP port (587 for TLS)
FROM_EMAIL - Sender email address
FROM_NAME - Sender display name
```

## Security Measures

### 1. **OTP Security**:
- 6-digit random OTP generation
- 15-minute expiration time
- Single-use tokens
- Secure token verification

### 2. **Rate Limiting**:
- IP-based attempt tracking
- Configurable hourly limits
- Automatic lockout system

### 3. **Password Security**:
- bcrypt hashing (PASSWORD_DEFAULT)
- Complexity requirements validation
- Current password duplicate prevention
- Secure password verification

### 4. **Session Security**:
- Verification token system
- Token cleanup after use
- Session-based validation

## Testing & Debugging

### Test URLs:
```
1. Start: localhost/eval/index.php?page=forgot_password
2. OTP: localhost/eval/index.php?page=verify_otp&email=test@gmail.com
3. Password: localhost/eval/index.php?page=new_password&email=test@gmail.com
```

### Debug Steps:
1. Check email configuration in `email_config_forgot.php`
2. Verify database connection in `db_connect.php`
3. Check browser console for JavaScript errors
4. Verify OTP email delivery to Gmail
5. Test complete flow from start to finish

### Common Issues:
- **OTP not received**: Check SMTP configuration and Gmail settings
- **Redirect to login**: Verify public pages array in `index.php`
- **Password validation**: Check password complexity requirements
- **Database errors**: Verify table structure and permissions

## Response Messages

### Success Messages:
- "OTP code has been sent to your email. Redirecting..."
- "OTP verified successfully! Redirecting..."
- "Password updated successfully! Redirecting to login..."

### Error Messages:
- "Email not found in our records."
- "Invalid or expired OTP code. Please try again."
- "Too many reset attempts. Please try again in an hour."
- "This password is already your current password. Please choose a different password."
- "Password must be at least 8 characters long."
- "Password must contain uppercase, lowercase, and numbers."

## Integration Notes

### Similar to Student OTP System:
- Uses same OTP generation logic
- Similar email delivery system
- Consistent UI/UX design
- Same security principles

### Differences from Email Link System:
- No more unreliable email links
- Faster user experience
- Better mobile compatibility
- Reduced email client issues
- More secure token system

## Future Enhancements

### Possible Improvements:
1. SMS OTP as backup option
2. Multiple email provider support
3. Enhanced rate limiting
4. OTP attempt logging
5. Password history prevention
6. Two-factor authentication integration

## Maintenance

### Regular Tasks:
1. Monitor OTP delivery success rates
2. Clean up expired tokens from database
3. Review rate limiting logs
4. Update SMTP credentials as needed
5. Test email delivery periodically

### Log Files to Monitor:
- PHP error logs for email sending issues
- Database logs for connection problems
- Web server logs for access patterns
- SMTP logs for delivery status
