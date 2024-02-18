<form method="post" action="submit_order.php">

  <label for="location">Location:</label>
  <select name="location" id="location">
    <option value="delhi">Delhi</option>
    <option value="other">Other in India</option>
  </select>

  <label for="size">Size:</label>
  <select name="size" id="size">
    <option value="a5">A5 (6" x 8")</option>
    <option value="a4">A4 (8" x 12")</option>
    <option value="a3">A3 (12" x 16")</option>
    <option value="a2">A2 (16" x 24")</option>
  </select>

  <label for="faces">Number of Faces:</label>
  <select name="faces" id="faces">
    <option value="1">1 Face</option>
    <option value="2">2 Faces</option>
    <option value="3">3 Faces</option>
    <option value="4">4 Faces</option>
    <option value="5">5 Faces</option>
  </select>

  <label for="quantity">Quantity:</label>
  <input type="number" id="quantity" name="quantity" min="1" value="1">

  <button type="submit">Add to Cart</button>

</form>
