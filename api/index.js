const express = require('express');
const cors = require('cors');
const db = require('./db');

const app = express();
const PORT = 5000;

app.use(cors());
app.use(express.json());

// test route
app.get('/', (req, res) => {
  res.send('Server is running');
});

// get products from MySQL
app.get('/products', (req, res) => {
  db.query('SELECT * FROM products', (err, result) => {
    if (err) {
      console.log(err);
      return res.status(500).json(err);
    }
    res.json(result);
  });
});

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});