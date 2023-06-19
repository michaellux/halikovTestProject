const { faker } = require('@faker-js/faker');
const { differenceInYears, getDate, getYear, format } = require('date-fns');

class User {
  constructor(name, age, hobbies, { street, city, country }, { day, month, year }) {
    this.user = this.createUser(name, age, hobbies, { street, city, country }, { day, month, year });
  }

  createUser = (name, age, hobbies, { street, city, country }, { day, month, year }) => {
    this.name = name;
    this.age = age;
    this.hobbies = hobbies;
    this.address = { street, city, country };
    this.birthday = { day, month, year };
  }

  getAge() {
    return this.age;
  }
}

class Project
{
  constructor(users) {
    if (users) {
      this.users = users;
    }
    else {
      this.users = this.generateUsers();
    }
  }

  generateUsers() {
    const users = [];
    for (let index = 0; index < 20; index++) {
      const randomName = faker.person.firstName();
      const randomBirthDate = faker.date.birthdate({ min: 18, max: 65, mode: 'age' });
      const currentDate = new Date();
      const randomAge = differenceInYears(currentDate, randomBirthDate);

      let randomHobbies = [];
      for (let index = 0; index < 5; index++) {
        randomHobbies = [...randomHobbies, faker.lorem.word()];
      }
      const randomAddress = {
        street: faker.location.street(),
        city: faker.location.city(),
        country: faker.location.country()
      };
      const randomBirthday = {
        day: getDate(randomBirthDate),
        month: format(randomBirthDate, 'MMMM'),
        year: getYear(randomBirthDate),
      };

      let user = new User(randomName, randomAge, randomHobbies, randomAddress, randomBirthday);
      users.push(user);
    }

    return users;
  }

  findUserByName(name) {
    let result = this.users.filter((user) => (user.user.name === name));
    return result;
  }

  findUser(name, age) {
    return this.users.filter((user) => (user.name === name) && (user.age === Number(age)));
  }

  filterUsers(ageFrom, ageTo) {
    return this.users.filter((user) => (user.age >= Number(ageFrom)) && (user.age <= Number(ageTo)));
  }

  addHobby(name, hobby) {
    const changedUsers = [];
    let targetUsers = this.users.filter((user) => user.name === name);
    targetUsers.forEach(targetUser => {
      targetUser.hobbies = [...targetUser.hobbies, hobby];
      changedUsers.push(targetUser);
    });
    return changedUsers;
  }

  removeHobby(name, hobby) {
    const changedUsers = []
    let targetUsers = this.users.filter((user) => user.name === name);
    targetUsers.forEach(targetUser => {
      let filteredHobbies = targetUser.hobbies.filter((targetHobby) => targetHobby != hobby);
      targetUser.hobbies = filteredHobbies;
      changedUsers.push(targetUser);
    });

    return changedUsers;
  }

  getYoungestUser() {
    const allUsersAge = this.users.map(user => user.age);
    const minUserAge = Math.min(...allUsersAge);
    return this.users.filter((user) => user.age === minUserAge);
  }

  countHobbies(hobby) {
    let counter = 0;
    this.users.forEach(user => {
      if (user.hobbies.includes(hobby)) {
        counter++;
      }
    });
    return counter;
  }

  findUsersBorn(day, month) {
    return this.users.filter((user) => (user.birthday.day === Number(day))
      && (user.birthday.month === month));
  }
}

function getUsers() {
  let project = new Project();
  console.log("return");
  return project.users;
}

function testGetAge() {
  let project = new Project();
  let user = project.users[0];
  console.log(user);
  let age = user.getAge();
  console.log(`--- age=${age} ---`);
}

testGetAge();