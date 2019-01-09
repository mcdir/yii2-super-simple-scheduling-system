const STUDENT_QUERY = 'student/';

export default class ApiService {

    _apiBase = 'http://localhost:8011/api/';

    fetchResource = async (url, prop={}) => {
        const res = await fetch(url, prop);
        if (!res.ok) {
            alert(`Could not fetch ${url} received ${res.status}`);
            throw new Error(`Could not fetch ${url} received ${res.status}`)
        }
        return await res.json();
    };

    getStudents = async () => {
        const res =  this.fetchResource(`${this._apiBase}${STUDENT_QUERY}`);

        return res;
    };

    deleteStudent = async (id) => {
        const res =  this.fetchResource(`${this._apiBase}${STUDENT_QUERY}delete/${id}`,{
            method: 'delete'
        // }).catch(reason => console.log(reason.message));
        });

        return res;
    };

    updateStudent = async (id, data) => {
        const res =  this.fetchResource(`${this._apiBase}${STUDENT_QUERY}update/${id}`,{
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                "Content-Type": "application/json",
            },
            body: JSON.stringify(this._transToStudents(data))
        });

        return res;
    };

    createStudent = async (data) => {
        const res =  this.fetchResource(`${this._apiBase}${STUDENT_QUERY}create/`,{
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                "Content-Type": "application/json",
            },
            body: JSON.stringify(this._transToStudents(data))
        });

        return res;
    };

    _transFromStudents = (student) => {
        return {
            id: student.id,
            lastName: student.last_name,
            firstName: student.first_name,
        }
    }

    _transToStudents = (student) => {
        return {
            id: student.id,
            last_name: student.lastName,
            first_name: student.firstName,
        }
    }

}