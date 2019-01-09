import React, { useState, useEffect } from 'react'

const EditStudentForm = props => {
  const [ student, setStudent ] = useState(props.currentStudent);

  useEffect(
    () => {
      setStudent(props.currentStudent)
    },
    [ props ]
  );
  // You can tell React to skip applying an effect if certain values haven’t changed between re-renders. [ props ]

  const handleInputChange = event => {
    const { name, value } = event.target;

    setStudent({ ...student, [name]: value })
  };

  return (
    <form
      onSubmit={event => {
        event.preventDefault();

        props.updateStudent(student.id, student)
      }}
    >
      <label>First name</label>
      <input type="text" name="firstName" value={student.firstName} onChange={handleInputChange} />
      <label>Last name</label>
      <input type="text" name="lastName" value={student.lastName} onChange={handleInputChange} />
      <button>Update student</button>
      <button onClick={() => props.setEditing(false)} className="button muted-button">
        Cancel
      </button>
    </form>
  )
}

export default EditStudentForm
