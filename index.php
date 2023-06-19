<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script type="module" src="./functions.js"></script>
  <?php include('functions.php'); ?>
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
          <form class="callFunction" id="findUser" action="index.php">
            <input type="hidden" name="function" value="findUser">
            <label for="name">Name:</label>
            <input required name="name" type="text" />
            <label for="age">Age:</label>
            <input required name="age" type="text" />
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="findUserResult"><?= $findUserResult ?></div>
          </form>
        </div>
        <div>
          <h1>FilterUsers</h1>
          <form class="callFunction" id="filterUsers" action="index.php">
            <input type="hidden" name="function" value="filterUsers">
            <label for="ageFrom">Age from:</label>
            <input required name="ageFrom" type="text" />
            <label for="ageTo">Age to:</label>
            <input required name="ageTo" type="text" />
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="filterUsersResult"><?= $filterUsersResult ?></div>
          </form>
        </div>
        <div>
          <h1>AddHobby</h1>
          <form class="callFunction" id="addHobby" action="index.php">
            <input type="hidden" name="function" value="addHobby">
            <label for="name">Name:</label>
            <input required name="name" type="text" />
            <label for="hobby">Hobby:</label>
            <input required name="hobby" type="text" />
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="addHobbyResult"><?= $addHobbyResult ?></div>
          </form>
        </div>
        <div>
          <h1>RemoveHobby</h1>
          <form class="callFunction" id="removeHobby" action="index.php">
            <input type="hidden" name="function" value="removeHobby">
            <label for="name">Name:</label>
            <input required name="name" type="text" />
            <label for="hobby">Hobby:</label>
            <input required name="hobby" type="text" />
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="removeHobbyResult"><?= $removeHobbyResult ?></div>
          </form>
        </div>
        <div>
          <h1>GetYoungestUser</h1>
          <form class="callFunction" id="getYoungestUser" action="index.php">
            <input type="hidden" name="function" value="getYoungestUser">
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="getYoungestUserResult"><?= $getYoungestUserResult ?></div>
          </form>
        </div>

        <div>
          <h1>CountHobbies</h1>
          <form class="callFunction" id="countHobbies" action="index.php">
            <input type="hidden" name="function" value="countHobbies">
            <label for="hobby">Hobby:</label>
            <input required name="hobby" type="text" />
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="countHobbiesResult"><?= $countHobbiesResult ?></div>
          </form>
        </div>
        <div>
          <h1>FindUsersBorn</h1>
          <form class="callFunction" id="findUsersBorn" action="index.php">
            <input type="hidden" name="function" value="findUsersBorn">
            <label for="day">Day:</label>
            <input required name="day" type="text" />
            <label for="month">Month:</label>
            <input required name="month" type="text" />
            <div style="margin: 1rem auto;">
              <input class="byjs" type="submit" value="Выполнить JS">
              <input class="byphp" type="submit" value="Выполнить PHP">
            </div>
            <div id="findUsersBornResult"><?= $findUsersBornResult ?></div>
          </form>
        </div>
        <script type="module">
          import users from './users.json' assert { type: 'json' };
          import {
            Project, printJson
          } from './functions.js';

          let forms = document.querySelectorAll('.callFunction');
          forms.forEach(form => {
            form.addEventListener('submit', function(event) {
              if (event.submitter.className === 'byjs') {
                event.preventDefault();

                let formData = new FormData(form);
                let functionName = formData.get('function');
                let result = '';
                let type = '';
                let project = new Project(users);
                switch (functionName) {
                  case 'findUser':
                    result = project.findUser(formData.get('name'), formData.get('age'));
                    break;
                  case 'filterUsers':
                    result = project.filterUsers(formData.get('ageFrom'), formData.get('ageTo'));
                    break;
                  case 'addHobby':
                    result = project.addHobby(formData.get('name'), formData.get('hobby'));
                    break;
                  case 'removeHobby':
                    result = project.removeHobby(formData.get('name'), formData.get('hobby'));
                    break;
                  case 'getYoungestUser':
                    result = project.getYoungestUser();
                    break;
                  case 'countHobbies':
                    result = project.countHobbies(formData.get('hobby'));
                    break;
                  case 'findUsersBorn':
                    result = project.findUsersBorn(formData.get('day'), formData.get('month'));
                    break;
                  default:
                    break;
                }
                if (functionName === 'countHobbies') {
                  document.getElementById(`${functionName}Result`).innerHTML = result;
                } else {
                  document.getElementById(`${functionName}Result`).innerHTML = result != '' ? printJson(result) : "Пользователь не найден";
                }
              }
            });
          });
        </script>
      </div>
      <div style="width: 60%;">
        <?= $jsonTable ?>
      </div>
    </div>
  <?php else : ?>
    <script type="module">
      import {
        getUsers
      } from './functions.js';

      let form = document.querySelector('#getData');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(form);
        let users = getUsers();
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