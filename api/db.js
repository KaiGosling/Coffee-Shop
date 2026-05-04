const mysql = require('mysql2');
require('dotenv').config();

const db = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME
});

if (!process.env.DB_HOST || !process.env.DB_USER || !process.env.DB_NAME) {
  console.error('Missing DB environment variables');
}

db.connect((err) => {
  if (err) {
    console.error('MySQL connection failed:', err);
    return;
  }
  console.log('MySQL Connected!');
});

module.exports = db;