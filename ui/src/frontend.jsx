import { useEffect, useState } from "react";

function App() {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    fetch("http://localhost:5000/products")
      .then((res) => res.json())
      .then((data) => setProducts(data))
      .catch((err) => console.log(err));
  }, []);

  return (
    <div>
      <h1>Coffee Shop Products</h1>
      {products.map((product) => (
        <div key={product.product_id}>
          <h2>{product.name}</h2>
          <p>Price: ${product.price}</p>
        </div>
      ))}
    </div>
  );
}

export default App;