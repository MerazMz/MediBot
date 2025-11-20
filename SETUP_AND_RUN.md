# Medibot Chatbot - Complete Setup and Run Guide

This comprehensive guide will walk you through the entire setup process from installing XAMPP to running both the PHP web application and Python chatbot server.

---

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Installing XAMPP](#installing-xampp)
3. [Setting Up the Database](#setting-up-the-database)
4. [Configuring PHP Application](#configuring-php-application)
5. [Setting Up Python Environment](#setting-up-python-environment)
6. [Running the Application](#running-the-application)
7. [Testing the Setup](#testing-the-setup)
8. [Troubleshooting](#troubleshooting)

---

## Prerequisites

Before starting, ensure you have:
- A computer running Windows, macOS, or Linux
- Administrative/root privileges
- Internet connection for downloading dependencies
- Google Gemini API key (get it from [Google AI Studio](https://makersuite.google.com/app/apikey))

---

## Installing XAMPP

### Step 1: Download XAMPP

1. Visit the official XAMPP website: [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Download the appropriate version for your operating system:
   - **Windows**: Download the `.exe` installer
   - **macOS**: Download the `.dmg` file
   - **Linux**: Download the `.run` file

### Step 2: Install XAMPP

#### For Windows:
1. Double-click the downloaded `.exe` file
2. If prompted by Windows Defender, click **"Yes"** to allow
3. Click **"Next"** through the installation wizard
4. Select components to install (ensure **Apache**, **MySQL**, and **phpMyAdmin** are checked)
5. Choose installation directory (default: `C:\xampp`)
6. Click **"Next"** and then **"Finish"**

#### For macOS:
1. Open the downloaded `.dmg` file
2. Drag the XAMPP icon to the Applications folder
3. Open Terminal and navigate to the XAMPP directory
4. Run: `sudo chmod +x /Applications/XAMPP/xamppfiles/xampp`
5. Start XAMPP using: `sudo /Applications/XAMPP/xamppfiles/xampp start`

#### For Linux:
1. Open Terminal
2. Navigate to the directory containing the downloaded file
3. Make it executable: `chmod +x xampp-linux-*-installer.run`
4. Run the installer: `sudo ./xampp-linux-*-installer.run`
5. Follow the on-screen instructions

### Step 3: Start XAMPP Control Panel

#### Windows:
1. Open **XAMPP Control Panel** from Start Menu
2. Click **"Start"** next to **Apache**
3. Click **"Start"** next to **MySQL**
4. Wait until both show **"Running"** status (green highlight)

#### macOS/Linux:
```bash
sudo /Applications/XAMPP/xamppfiles/xampp start
# Or for Linux: sudo /opt/lampp/lampp start
```

### Step 4: Verify XAMPP Installation

1. Open your web browser
2. Navigate to: `http://localhost`
3. You should see the XAMPP welcome page
4. Click on **phpMyAdmin** in the top menu to verify database access

---

## Setting Up the Database

### Step 1: Access phpMyAdmin

1. Open your web browser
2. Navigate to: `http://localhost/phpmyadmin`
3. You should see the phpMyAdmin interface

### Step 2: Create the Database

#### Method 1: Using the SQL File (Recommended)

1. In phpMyAdmin, click on the **"SQL"** tab at the top
2. Click on the **"Choose File"** button or open the file in a text editor
3. Locate and open the `database.sql` file from your project directory
4. Copy the entire contents if using text editor method
5. Paste it into the SQL query box in phpMyAdmin
6. Click **"Go"** button at the bottom right
7. You should see a success message

#### Method 2: Manual Database Creation

1. Click on **"New"** in the left sidebar
2. Enter database name: `login_system`
3. Select **"utf8mb4_unicode_ci"** as collation
4. Click **"Create"**
5. Now import the SQL file:
   - Select `login_system` database from left sidebar
   - Click **"Import"** tab
   - Click **"Choose File"** and select `database.sql`
   - Click **"Go"** at the bottom
   - Wait for the success message

### Step 3: Verify Database Tables

1. In phpMyAdmin, click on `login_system` database in the left sidebar
2. You should see the following tables:
   - `users`
   - `user_sessions`
   - `login_attempts`
   - `user_activity_log`
3. Click on each table to verify they were created successfully

### Step 4: Configure Database Connection (Optional)

The default configuration should work, but if you changed MySQL settings:

1. Open `db_connect.php` in a text editor
2. Update the following if needed:
   ```php
   $host = 'localhost';      // Usually 'localhost'
   $dbname = 'login_system'; // Database name
   $username = 'root';       // Default is 'root'
   $password = '';           // Default is empty
   ```
3. Save the file

---

## Configuring PHP Application

### Step 1: Copy Project to XAMPP Directory

1. Locate your XAMPP `htdocs` folder:
   - **Windows**: `C:\xampp\htdocs\`
   - **macOS**: `/Applications/XAMPP/xamppfiles/htdocs/`
   - **Linux**: `/opt/lampp/htdocs/`

2. Copy the entire `chatbot` project folder into `htdocs`
   - Final path should be: `htdocs/chatbot/`

### Step 2: Verify File Permissions (macOS/Linux only)

```bash
# Navigate to the project directory
cd /Applications/XAMPP/xamppfiles/htdocs/chatbot/
# Or for Linux: cd /opt/lampp/htdocs/chatbot/

# Set appropriate permissions
chmod -R 755 .
chmod -R 777 assets/  # If you have an assets folder for uploads
```

### Step 3: Test PHP Application

1. Open your web browser
2. Navigate to: `http://localhost/chatbot/`
3. You should see the main landing page
4. Try accessing: `http://localhost/chatbot/login.php`
5. Try accessing: `http://localhost/chatbot/signup.php`

---

## Setting Up Python Environment

### Step 1: Install Python

1. **Check if Python is installed:**
   ```bash
   python --version
   # or
   python3 --version
   ```

2. **If not installed, download and install Python:**
   - Visit: [https://www.python.org/downloads/](https://www.python.org/downloads/)
   - Download Python 3.8 or higher
   - During installation on Windows, **check "Add Python to PATH"**
   - Complete the installation

### Step 2: Navigate to Project Directory

Open Terminal/Command Prompt and navigate to the project:

```bash
# Windows
cd C:\xampp\htdocs\chatbot

# macOS
cd /Applications/XAMPP/xamppfiles/htdocs/chatbot

# Linux
cd /opt/lampp/htdocs/chatbot
```

### Step 3: Create Virtual Environment (Recommended)

```bash
# Create virtual environment
python -m venv venv

# Activate virtual environment
# Windows:
venv\Scripts\activate

# macOS/Linux:
source venv/bin/activate
```

You should see `(venv)` prefix in your terminal prompt.

### Step 4: Install Python Dependencies

```bash
# Make sure you're in the chatbot directory and venv is activated
pip install -r requirements.txt
```

This will install:
- `Flask` - Web framework for the chatbot API
- `Flask-Cors` - Cross-Origin Resource Sharing support
- `google-generativeai` - Google Gemini API client
- `python-dotenv` - Environment variable management

### Step 5: Configure Environment Variables

1. **Create `.env` file:**
   ```bash
   # Copy the example file (if it exists)
   cp .env.example .env
   
   # Or create a new file
   # Windows: type nul > .env
   # macOS/Linux: touch .env
   ```

2. **Edit `.env` file:**
   Open `.env` in a text editor and add:
   ```
   GEMINI_API_KEY=your_actual_api_key_here
   ```

3. **Get your Gemini API Key:**
   - Visit: [https://makersuite.google.com/app/apikey](https://makersuite.google.com/app/apikey)
   - Sign in with your Google account
   - Click **"Create API Key"**
   - Copy the generated key
   - Paste it in your `.env` file after `GEMINI_API_KEY=`

4. **Save the `.env` file**

> **⚠️ IMPORTANT**: Never commit the `.env` file to version control. It's already listed in `.gitignore`.

---

## Running the Application

You need to run **both** the PHP server (XAMPP) and the Python chatbot server simultaneously.

### Step 1: Start XAMPP Services

1. **Open XAMPP Control Panel**
2. **Start Apache** (click "Start" button)
3. **Start MySQL** (click "Start" button)
4. Ensure both show **"Running"** status

### Step 2: Start Python Chatbot Server

1. **Open a new Terminal/Command Prompt window**
2. **Navigate to project directory:**
   ```bash
   cd C:\xampp\htdocs\chatbot  # Windows
   # or appropriate path for your OS
   ```

3. **Activate virtual environment** (if you created one):
   ```bash
   # Windows:
   venv\Scripts\activate
   
   # macOS/Linux:
   source venv/bin/activate
   ```

4. **Run the chatbot server:**
   ```bash
   python chatbot.py
   ```

5. **Verify the server started:**
   You should see output like:
   ```
   Starting server with API key: AIzaSyBxxx...
    * Serving Flask app 'chatbot'
    * Debug mode: on
    * Running on http://127.0.0.1:5000
   ```

6. **Keep this terminal window open** - the server needs to run continuously

### Step 3: Access the Web Application

1. Open your web browser
2. Navigate to: `http://localhost/chatbot/`
3. The chatbot should now be functional on the website

---

## Testing the Setup

### Test 1: Database Connection

1. Go to: `http://localhost/chatbot/signup.php`
2. Create a test account:
   - Enter Full Name
   - Enter Email
   - Enter Password
   - Click "Sign Up"
3. If successful, you should be redirected or see a success message
4. Verify in phpMyAdmin:
   - Go to `login_system` database
   - Click on `users` table
   - You should see your new user entry

### Test 2: Login Functionality

1. Go to: `http://localhost/chatbot/login.php`
2. Enter the credentials you just created
3. Click "Login"
4. You should be logged in successfully

### Test 3: Chatbot Functionality

1. Navigate to the page where the chatbot is integrated
2. Type a medical question in the chatbot interface
3. Examples to test:
   - "What are the symptoms of flu?"
   - "How can I treat a headache?"
   - "What should I do for a fever?"
4. The chatbot should respond with relevant medical information

### Test 4: Python Server Connection

Open a new terminal window and test the API directly:

```bash
# Test using curl (Windows users might need to install curl or use Git Bash)
curl -X POST http://localhost:5000/chat \
  -H "Content-Type: application/json" \
  -d "{\"message\": \"Hello\", \"session_id\": \"test123\"}"
```

You should receive a JSON response with the chatbot's reply.

---

## Troubleshooting

### XAMPP Issues

#### Apache won't start
- **Port 80 conflict**: Another program (Skype, IIS) is using port 80
  - Solution: Stop the conflicting program or change Apache port
  - Edit `httpd.conf`: Change `Listen 80` to `Listen 8080`
  - Access via: `http://localhost:8080/`

#### MySQL won't start
- **Port 3306 conflict**: Another MySQL instance is running
  - Solution: Stop other MySQL services or change port
  - Edit `my.ini`: Change port number

### Database Issues

#### "Access Denied" error
- Check `db_connect.php` credentials match your MySQL setup
- Default: username=`root`, password=empty
- If you set a MySQL password, update `db_connect.php`

#### Tables not created
- Ensure `database.sql` was imported successfully
- Check for error messages in phpMyAdmin
- Try creating database manually and importing again

### Python Chatbot Issues

#### "GEMINI_API_KEY not found"
- Ensure `.env` file exists in the project root
- Verify the API key is correctly formatted
- No quotes needed around the key value

#### "Module not found" errors
- Ensure virtual environment is activated
- Run `pip install -r requirements.txt` again
- Check Python version (should be 3.8+)

#### Port 5000 already in use
- Another application is using port 5000
- Solution: Edit `chatbot.py`, change the port:
  ```python
  app.run(debug=True, port=5001)  # Use 5001 instead
  ```
- Update frontend code to use new port

#### Chatbot returns "I'm having trouble connecting"
- Check your internet connection (Gemini API requires internet)
- Verify API key is valid and active
- Check API quota hasn't been exceeded

### General Issues

#### CORS errors in browser console
- Ensure `Flask-Cors` is installed
- Verify `CORS(app)` is in `chatbot.py`
- Check browser developer console for specific CORS errors

#### 404 Not Found errors
- Verify project is in correct `htdocs` folder
- Check file paths are correct
- Ensure Apache is running

#### Blank pages
- Check PHP error logs in XAMPP control panel
- Enable error display in PHP:
  - Edit `php.ini`
  - Set `display_errors = On`
  - Restart Apache

---

## Important Notes

### Security Reminders

1. **Never commit `.env` file** - Contains sensitive API keys
2. **Change default MySQL password** - In production, set a strong password
3. **Use HTTPS in production** - Current setup is for development only
4. **Validate user input** - PHP files should sanitize all inputs

### Development vs Production

This setup is for **local development** only. For production deployment:
- Use a proper web server (not XAMPP)
- Enable HTTPS/SSL
- Set strong database passwords
- Use environment-specific configurations
- Implement proper error handling
- Enable security headers

### API Key Management

- **Free tier limits**: Google Gemini API has rate limits
- **Monitor usage**: Check your API dashboard regularly
- **Backup key**: Save your API key securely
- **Rotate keys**: Periodically generate new keys for security

---

## Quick Start Checklist

- [ ] XAMPP installed and running
- [ ] MySQL service started
- [ ] Database `login_system` created
- [ ] Tables imported from `database.sql`
- [ ] Project copied to `htdocs/chatbot/`
- [ ] Python 3.8+ installed
- [ ] Virtual environment created and activated
- [ ] Dependencies installed (`pip install -r requirements.txt`)
- [ ] `.env` file created with valid `GEMINI_API_KEY`
- [ ] Python chatbot server running (`python chatbot.py`)
- [ ] Web application accessible at `http://localhost/chatbot/`
- [ ] Chatbot responding to messages

---

## Support and Resources

- **XAMPP Documentation**: [https://www.apachefriends.org/documentation.html](https://www.apachefriends.org/documentation.html)
- **Flask Documentation**: [https://flask.palletsprojects.com/](https://flask.palletsprojects.com/)
- **Google Gemini API**: [https://ai.google.dev/docs](https://ai.google.dev/docs)
- **PHP Documentation**: [https://www.php.net/docs.php](https://www.php.net/docs.php)

---

## Developer Information

- **Project**: Medibot AI Chatbot
- **Developer**: Meraz
- **AI Model**: Google Gemini 2.0 Flash
- **Backend**: Flask (Python) + PHP
- **Database**: MySQL
- **Frontend**: HTML/CSS/JavaScript

---

*Last Updated: November 2025*
