import React, { useState } from 'react'

const AddStudentForm = props => {
	const initialFormState = { id: null, lastName: '', firstName: '' }
	const [ student, setStudent ] = useState(initialFormState)

	const handleInputChange = event => {
		const { name, value } = event.target;

		setStudent({ ...student, [name]: value })
	};

	return (
		<form
			onSubmit={event => {
				event.preventDefault();
				if (!student.lastName || !student.firstName){
					return;
				}

				props.addStudent(student);
				setStudent(initialFormState);
			}}
		>
			<label>First name</label>
			<input type="text" name="firstName" value={student.firstName} onChange={handleInputChange} />
			<label>Last name</label>
			<input type="text" name="lastName" value={student.lastName} onChange={handleInputChange} />
			<button>Add new student</button>
		</form>
	)
};


export default AddStudentForm
