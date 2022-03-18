<html>
    <style>
body {
  font-family: Sans-Serif;
}

#start-payment-button {
    cursor: pointer;
    position: relative;
    background-color: blueviolet;
    color: #fff;
    max-width: 30%;
    padding: 10px;
    font-weight: 600;
    font-size: 14px;
    border-radius: 10px;
    border: none;
    transition: all .1s ease-in;
}
        </style>
<body>
  <h1>Rave standard</h1>
  <div class="card">
    <img src="img/book.jpg" alt="Denim Jeans" style="width:100%">
    <h1>Your heart is the sea</h1>
    <p class="price">&#8358;3000</p>
    <form action="processpayment.php" method="POST">
      <input type="hidden" id="amount" name="amount" value="1">
      <input type="email" id="email" name="email" placeholder="email" value="viktinho56@gmail.com">
      <input type="text" id="phone" placeholder="phone number" name="phone" value="08012345678">
      <p>By Nikita Gill</p>
      <p><button type="submit" id="submit">Buy Now</button></p>
    </form>
  </div>
</body>
</html>