<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script type="module" src="./functions.js"></script>
  <?php include('listener.php'); ?>
</head>
<body style="margin: 1rem;">
  <style>
    div>table>tbody {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }
    div>table>tbody tr {
      background: #d9dee6;
    }
  </style>
  <?php if (file_exists('users.json')) : ?>
    <div style="display: flex;">
      <div style="width: 40%;">
        <div>
          <h1>FindUser</h1>
          <form id="findUser" action="">
            <label for="name">Name:</label>
            <input name="name" type="text" />
            <label for="age">Age:</label>
            <input name="age" type="text" />
            <div style="margin-top: 1rem;">
               <input type="submit" value="Выполнить JS">
               <input type="submit" value="Выполнить PHP">
            </div>
          </form>
        </div>
        <div>
          <h1>FilterUsers</h1>
          <form id="filterUsers" action="">
            <label for="ageFrom">Age from:</label>
            <input name="ageFrom" type="text" />
            <label for="ageTo">Age to:</label>
            <input name="ageTo" type="text" />
            <div style="margin-top: 1rem;">
               <input type="submit" value="Выполнить JS">
               <input type="submit" value="Выполнить PHP">
            </div>
          </form>
        </div>
      </div>
      <div style="width: 60%;">
              <?php include('functions.php'); ?>

      </div>
    </div>
  <?php else :?>
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
        window.location.reload();
      })
      .catch(function(error) {
        console.error(error);
      });
    });

  </script>
    <form id="getData" action="listener.php" method="POST">
      <input type="submit" value="Получить данные">
    </form>
  <?php endif; ?>
</body>
</html>