# Summary
Create an REST API to for a system that assigns students to lessons. API will be used
by both a UI and programmatically by other systems.

# Deliverables:
- (required) ​~~PHP code via a github repository or other SC system (e.g. bitbucket).~~
- (required) ​~~a short write-up around what technologies/frameworks you are/would
use in implementing various parts/tiers of this system~~
- (optional) ​~~deployable/runnable application + simple instruction “how to..” run this~~
- (optional) ~~API documentation~~

# Timeframe​ :
The scope of the exercise is somewhat fluid so do not spend more than 8 hours on it.

# Detailed Requirements:
## Models
Student = { student id, last name, first name }
Course  = { code, title, description }
Lesson  = { lesson id, title_about }

Student can attend unlimited number of Lessons 
Lessons can have unlimited number of Students

Student can attend only one of Course 
Course can have only one of Student

# Operations
- ~~Create/Edit/Delete Student~~
- ~~Create/Edit/Delete Course~~
- ~~Create/Edit/Delete Lesson~~
- ~~Browse list of all Students~~
- ~~Browse list of all Courses~~
- ~~Browse list of all Lessons~~

- ~~View all Students assigned to a Lesson~~
- ~~View all Lesson assigned to a Student~~
- ~~Search Student/Lesson by available fields/associations~~

# Security

None

## Error Handling
Does not need to be thorough. Just enough to demonstrate how you would handle
various types of errors (business, system)

# Persistence
Not part of the evaluation. Feel free to mock it if that’s faster.
Do Not Send

# Assumptions

This is yii example of CRUD and swagger api application with many-to-one and many-to-many relations.
Full functionality is done via admin side. Some part of CRUD functionality you can see
at simple react-front-hook front app.

# technologies/frameworks

- yii2
- mysql
- docker
- swagger
- react with hooks

# how to

## Init project

```bash
docker-compose build
docker-compose up
./init-project.sh
```

- Open in a browser http://localhost:8011/home
- Swagger API DOC http://localhost:8011/api/docs
- React front CRUD example app http://localhost:3000

## Update fixture

```bash
# 
yii fixture/generate Course --count=10
yii fixture/generate Student --count=20

yii migrate
yii fixture/load "*"
```

# Known issues

```bash
mysqld: Can't create/write to file '/var/lib/mysql/is_writable' (Errcode: 13 - Permission denied)
```
To fix it run in console:

```bash
sudo chmod -R 777 docker/mysql/data/db/
```
