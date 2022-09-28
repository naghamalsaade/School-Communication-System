<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://previews.123rf.com/images/butenkow/butenkow1612/butenkow161204080/67428208-template-design-logo-school-vector-illustration-of-icon.jpg" width="400"></a></p>

## About Project

The communication management system between the parents of students and the school administration, this system is used by three types of users: the person responsible for students and communicating with parents within the school - the student’s guardian - the manager who is considered

The Agile model was used in the development process.

### Security

- Implement an efficient and secure login system (Authentication).
- Giving custom permissions to each type of user (Authorization).
- The password is stored encrypted within Database (Encryption).
- Encrypt sensitive data such as complaints sent through encryption algorithms (Encryption).
  
### Reusability

- The possibility of using the application by several schools, as it is not specific to a particular school Requirements Designed to fit the requirements of any school.

- It is possible to start from the system and complete the development of other systems in the educational field.

## Manager (Super Admin) Requirements:

- The manager added a new class, provided that this row class not already exist.
- Adding a new group that does not already exist.
- Add a new administrator and specify its username and password.
- Add a new student and specify his username and password.
- View all registered administrator within the app.
- View all registered students within the application.
- Delete an existing administrator.
- Delete an existing student.
- Modify data for an existing administrator.
- Modify an existing student's data.
- Search for a administrator or student registered within the application, i.e. who has an account.


## Administrator Requirements:

- Log in to the application with its username and password.
- Log out of the application, knowing that it must be logged in previously.
- View the complaints that he sent to parents.
- View all the complaints received by the administrator from the parents of the students.
- View all the attendance check to a specific student of the students who are supervised by the administrator.
- View student marks from students who are supervised by the administrator.
- View the schedules of the group supervised by the administrator.
- View the classes events supervised by the administrator.
- Add a attendance check for a student who is supervised by the administrator.
- Add an event and specify the classes available to them for the event.
- Adding educational content to a specific subject of the classes supervised by the administrator.
- Adding work schedules, exams, or quize to a group of the groups who is supervised by the administrator.
- Add student marks for a specific group and a specific subject.


## Student Requirements:

- Parent login to the application using his username and password.
- Signing the parent out of the application, bearing in mind that he must be logged in previously.
- Parent displays all the student's marks.
- Parent display of all activities of the student's class.
- Parent view all work schedules for the student’s class and group.
- Parent view all the subjects that the student studies according to his group.
- Parent view attendance check the student (attendance - absence - tardiness).
- View all educational content for a specific subject by student class.
- View all justification for absence sent by the parent.
- Show justification of absence for a specific absence.
- Sending a justification for a specific absence by the parent.
- Parent sends a complaint to the administrator who is following up on his son.
- View the complaints sent by the parents.
- View the complaints received by parents from the administrator.