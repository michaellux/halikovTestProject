//const { faker } = require('@faker-js/faker');
//const { differenceInYears, getDate, getYear, format } = require('date-fns');
import { faker } from 'https://cdn.skypack.dev/@faker-js/faker';
import { differenceInYears, getDate, getYear, format } from 'https://cdn.jsdelivr.net/npm/date-fns@2.23.0/esm/index.js'

export class User {
  constructor(name, age, hobbies, { street, city, country }, { day, month, year }) {
    this.createUser(name, age, hobbies, { street, city, country }, { day, month, year });
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

export class Project
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

    for (let index = 0; index < users.length; index++) {
      console.log(users[index]);
    }

    return users;
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

export function getUsers() {
  let project = new Project();
  console.log("return");
  return project.users;
}

export function printJson(arr) {
  let html = "";
  if (arr && Array.isArray(arr)) {
    html += arrayToHtmlTableRecursive(arr);
  } else if (arr === null) {
    html = null;
  }
  return html;
}

function arrayToHtmlTableRecursive(arr) {
  let str = "<table><tbody>";
  for (let key in arr) {
    if (arr.hasOwnProperty(key)) {
      let val = arr[key];
      str += "<tr>";
      str += "<td>" + key + "</td>";
      str += "<td>";
      if (typeof val === 'object' && val !== null) {
        if (Object.keys(val).length > 0) {
          str += arrayToHtmlTableRecursive(val);
        }
      } else {
        str += "<strong>" + val + "</strong>";
      }
      str += "</td></tr>";
    }
  }
  str += "</tbody></table>";

  return str;
}