<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script type="module" src="./functions.js"></script>
   <?php include('functions.php'); ?>
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
    <?php include('listener.php'); ?>
    <div style="display: flex;">
      <div style="width: 40%;">
        <div>
          <h1>FindUser</h1>
          <form id="findUser" action="index.php">
            <input type="hidden" name="function" value="findUser">
            <label for="name">Name:</label>
            <input required name="name" type="text" />
            <label for="age">Age:</label>
            <input required name="age" type="text" />
            <div style="margin-top: 1rem;">
               <input type="submit" value="Выполнить JS">
               <input type="submit" value="Выполнить PHP">
            </div>
            <div><?= $findUserResult ?></div>
          </form>
        </div>
        <div>
          <h1>FilterUsers</h1>
          <form id="filterUsers" action="index.php">
            <input type="hidden" name="function" value="filterUsers">
            <label for="ageFrom">Age from:</label>
            <input required name="ageFrom" type="text" />
            <label for="ageTo">Age to:</label>
            <input required name="ageTo" type="text" />
            <div style="margin-top: 1rem;">
               <input type="submit" value="Выполнить JS">
               <input type="submit" value="Выполнить PHP">
            </div>
            <div><?= $filterUsersResult ?></div>
          </form>
        </div>


        <div>
           <h1>AddHobby</h1>
          <form id="addHobby" action="index.php">
            <input type="hidden" name="function" value="addHobby">
            <label for="name">Name:</label>
            <input required name="name" type="text" />
            <label for="hobby">Hobby:</label>
            <input required name="hobby" type="text" />
            <div style="margin-top: 1rem;">
               <input type="submit" value="Выполнить JS">
               <input type="submit" value="Выполнить PHP">
            </div>
            <div><?= $addHobbyResult ?></div>
          </form>
        </div>
        <div>
           <h1>RemoveHobby</h1>
          <form id="removeHobby" action="index.php">
            <input type="hidden" name="function" value="removeHobby">
            <label for="name">Name:</label>
            <input required name="name" type="text" />
            <label for="hobby">Hobby:</label>
            <input required name="hobby" type="text" />
            <div style="margin-top: 1rem;">
               <input type="submit" value="Выполнить JS">
               <input type="submit" value="Выполнить PHP">
            </div>
            <div><?= $removeHobbyResult ?></div>
          </form>
        </div>
      </div>
      <div style="width: 60%;">
         <?=$jsonTable ?>
      </div>
    </div>
  <?php else :?>
      <?php include('createjson.php'); ?>
      <script type="module">
    import getUsers from './functions.js';
    
    var form = document.querySelector('#getData');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      var formData = new FormData(form);
      var users = getUsers();
      console.log(users);
      fetch('createjson.php', {
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
    <form id="getData" action="createjson.php" method="POST">
      <input type="submit" value="Получить данные">
    </form>
  <?php endif; ?>
</body>
</html>

