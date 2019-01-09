import React, { useState, useEffect, Fragment } from 'react'
import AddStudentForm from './forms/AddStudentForm'
import EditStudentForm from './forms/EditStudentForm'
import StudentTable from './tables/StudentTable'
import ApiService from './api/api';

const App = () => {
	// Data
	const api = new ApiService();
	const studentData = [];
	const initialFormState = { id: null, lastName: '', firstName: '' };
	const showLimit = 30;

	// Setting state
	const [ students, setStudent ] = useState(studentData);
	const [ currentStudent, setCurrentStudent ] = useState(initialFormState);
	const [ editing, setEditing ] = useState(false);

    useEffect(async () => {
		api.getStudents()
			.then(data => {
				return data.map(api._transFromStudents).slice(0, showLimit);
			})
			.then(data => setStudent(data));
    }, []);

	// CRUD operations
	const addStudent = student => {
		// @todo get last id from a server
		student.id = students.length + 1;

		const res = api.createStudent(student);
		res.then(data => {
			if (data.status) {
				setStudent([ ...students, student ])
			} else {
				alert(`Error ${data}`);
			}
		}).catch(reason => console.log(`MESSAGE: ${reason.message}`));

	};

	const deleteStudent = id => {
		setEditing(false);

		const res = api.deleteStudent(id);
		res.then(data => {
			if (data.status) {
				setStudent(students.filter(student => student.id !== id));
			} else {
				alert(`Error ${data}`);
			}
		}).catch(reason => console.log(`MESSAGE: ${reason.message}`));
	};

	const updateStudent = (id, updatedStudent) => {
		setEditing(false);

		const res = api.updateStudent(id, updatedStudent);
		res.then(data => {
			if (data.status) {
				setStudent(students.map(student => (student.id === id ? updatedStudent : student)));
			} else {
				alert(`Error ${data}`);
			}
		}).catch(reason => console.log(`MESSAGE: ${reason.message}`));

	};

	const editStudentRow = student => {
		setEditing(true);

		setCurrentStudent({ id: student.id, lastName: student.lastName, firstName: student.firstName })
	};

	return (
		<div className="container">
			<h1>CRUD App with Hooks</h1>
			<div className="flex-row">
				<div className="flex-large">
					{editing ? (
						<Fragment>
							<h2>Edit student</h2>
							<EditStudentForm
								editing={editing}
								setEditing={setEditing}
								currentStudent={currentStudent}
								updateStudent={updateStudent}
							/>
						</Fragment>
					) : (
						<Fragment>
							<h2>Add student</h2>
							<AddStudentForm addStudent={addStudent} />
						</Fragment>
					)}
				</div>
				<div className="flex-large">
					<h2>View students</h2>
					<StudentTable students={students} editRow={editStudentRow} deleteStudent={deleteStudent} />
				</div>
			</div>
		</div>
	)
};

export default App
