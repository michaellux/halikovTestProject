const { faker } = require('@faker-js/faker');
const { differenceInYears, getDate, getMonth, getYear, format } = require('date-fns');

class User {
  constructor(name, age, hobbies, { street, city, country }, { day, month, year }) {
    this.user = this.createUser(name, age, hobbies, { street, city, country }, { day, month, year });
  }

  createUser = (name, age, hobbies, { street, city, country }, { day, month, year }) => {
    let user = {
      name,
      age,
      hobbies,
      address: { street, city, country },
      birthday: { day, month, year },
    }
    return user;
  }
}

User.prototype.getAge = function () {
  return this.user.age;
};

class Project
{
  constructor() {
    this.users = this.generateUsers();
  }

  generateUsers() {
    let users = [];
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
      users = [...users, user];
    }

    for (let index = 0; index < users.length; index++) {
      console.log(users[index]);
    }

    return users;
  }

  findUser(name, age) {
    return this.users.filter((user) => (user.name === name) && (user.age === age));
  }

  filterUsers(ageFrom, ageTo) {
    return this.users.filter((user) => (user.age >= ageFrom) && (user.age <= ageTo));
  }

  addHobby(name, hobby) {
    let targetUser = this.user.filter((user) => user.name === name);
    targetUser.hobbies = [...targetUser.hobbies, hobby];
  }

  removeHobby(name, hobby) {
    let targetUser = this.user.filter((user) => user.name === name);
    let filteredHobbies = targetUser.hobbies.filter((targetHobby) => targetHobby != hobby);
    targetUser.hobbies = filteredHobbies;
  }

  getYoungestUser() {
    const allUsersAge = this.users.map(user => user.age);
    const maxUserAge = Math.max(...allUsersAge);
    return this.users.filter((user) => user.age === maxUserAge);
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
    return this.users.filter((user) => (user.birthday.day === day)
    && (user.birthday.month === month));
  }
}

const testProject = () => {
  console.log("test");
  let project = new Project();
  console.log("test");
  var age = project.users[0].getAge();
}

testProject();