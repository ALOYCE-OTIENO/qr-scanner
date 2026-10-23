# QR Code Attendance and Job Output Tracking System

A Laravel-based application for tracking employee attendance and job output using QR codes. Employees can check in and out daily by scanning their unique QR codes, and administrators can track their work output and productivity.

## Features

- **QR Code Generation**: Generate unique QR codes for each employee
- **Attendance Tracking**: Daily check-in/check-out with QR code scanning
- **Job Output Tracking**: Record and manage employee work output
- **Dashboard**: Real-time statistics and recent activity overview
- **Employee Management**: Add, edit, and manage employee profiles
- **Authentication**: Secure login system with admin roles
- **Responsive Design**: Modern, mobile-friendly interface using Bootstrap 5

## Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- XAMPP (or any web server with PHP support)
- GD Extension (for QR code generation)

## Installation

### 1. Install Dependencies

Open your terminal in the project directory and run:

```bash
composer install
```

### 2. Configure Environment

Copy the example environment file:

```bash
copy .env.example .env
```

Edit the `.env` file and configure your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qr_attendance
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Create Database

Create a new MySQL database named `qr_attendance` (or whatever you specified in `.env`).

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Seed Database (Optional)

This will create an admin user:

```bash
php artisan db:seed
```

**Default Admin Credentials:**
- Email: `aloyceotieno254@gmail.com`
- Password: `aloyceM @254!!`

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage

### For Administrators

1. **Login** with admin credentials
2. **Add Employees** via the Employees section
3. **Generate QR Codes** for each employee
4. **Print/Distribute** QR codes to employees
5. **Monitor** attendance and job output via the Dashboard

### For Employees

1. **Scan QR Code** using the QR Scanner page
2. **Check In** when arriving at work
3. **Check Out** when leaving work
4. **View** attendance history and job outputs

## Project Structure

```
QR SCANNER/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── AttendanceController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── EmployeeController.php
│   │   │   ├── JobOutputController.php
│   │   │   └── QrCodeController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Attendance.php
│   │   ├── Employee.php
│   │   ├── JobOutput.php
│   │   └── User.php
│   └── Services/
│       └── QrCodeService.php
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── auth/
│       ├── attendance/
│       ├── employees/
│       ├── job-output/
│       └── qr-code/
└── routes/
```

## Database Schema

### Users
- Authentication and authorization
- Admin role management

### Employees
- Employee information
- Unique QR code for each employee
- Department and position tracking

### Attendances
- Daily check-in/check-out records
- Attendance status (present, late, absent)
- Work hours calculation

### Job Outputs
- Task completion tracking
- Quantity and quality metrics
- Status management (pending, completed, rejected)

## Security Considerations

- Change the default admin password after first login
- Use HTTPS in production
- Implement proper backup strategies
- Regularly update dependencies
- Configure proper file permissions

## Troubleshooting

### QR Code Not Displaying
- Ensure GD extension is enabled in PHP
- Check storage link is created: `php artisan storage:link`
- Verify public/storage directory has proper permissions

### Database Connection Errors
- Verify MySQL service is running
- Check database credentials in `.env`
- Ensure database exists

### Session Issues
- Clear config cache: `php artisan config:clear`
- Clear session cache: `php artisan session:clear`

## License

This project is open-source software licensed under the MIT license.

## Support

For issues and questions, please refer to the Laravel documentation: https://laravel.com/docs
