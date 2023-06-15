<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script type="module" src="./functions.js"></script>
  <script type="module">
    import getUsers from './functions.js';
    
    var form = document.querySelector('#getData');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      var formData = new FormData(form);
      var users = getUsers();
      console.log(users);
      fetch('listener.php', {
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(users),
        method: 'POST',
      })
      .then(function(response) {

      })
      .catch(function(error) {
        console.error(error);
      });
    });

  </script>
  <?php include('functions.php'); ?>
  <?php include('listener.php'); ?>
</head>
<body>
  <form id="getData" action="listener.php" method="POST">
    <input type="submit" value="Получить данные">
  </form>
  
</body>
</html>