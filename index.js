import Project from "./index.js";

export function getUsers() {
  let project = new Project();
  return project.users;
}