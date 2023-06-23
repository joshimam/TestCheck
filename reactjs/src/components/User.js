import axios from 'axios';
import React, { useEffect, useState } from 'react'

function User() {
  const [id,SetId]=useState("");
  const [name,SetName]=useState("");
  const [parentname,SetParentname]=useState("");
  const [employees, SetUsers] = useState([]);

  const ChangeMemberName = (pname) => {
    SetParentname(pname)
  }
  useEffect(() => {
    (async () => await Load())();
    }, []);

  async function Load()
  {
   const result= await axios.get("http://127.0.0.1:8000/api/employees");
              SetUsers(result.data);
              console.log(result.data);

  }

  async function editEmployee(employees)
  {
   SetName(employees.Name);
   SetParentname(employees.parentid);
   
   SetId(employees.id);
   
  }

  
  async function save(event)
  {
      event.preventDefault();
  try
      {
       await axios.post("http://127.0.0.1:8000/api/save",
      {
        name: name,
        parentname: parentname
      
      });
       alert("Employee Registation Successfully");
        SetId("");
        SetName("");
        SetParentname("");
        Load();
      
      }
  catch(err)
      {
       alert("User Registation Failed");
      }
 }

  async function update(event)
  {
   event.preventDefault();
  try
      {
       await axios.put("http://127.0.0.1:8000/api/update/"+ employees.find(u => u.id === id).id || id,
      {
        id: id,
        Name: name,
        parentid: parentname
      
      });
        alert("Registation Updateddddd");
        SetId("");
        SetName("");
        SetParentname("");
        Load();
      
      }
  catch(err)
      {
        alert("User Registation Failed");
      }
 }

  async function DeleteEmployee(id)
  {
      
       await axios.delete("http://127.0.0.1:8000/api/delete/" + id); 
       alert("Employee deleted Successfully");
       Load();
  
  }

  return (
      <div className="App">
       <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Parent</label>
    <select id="parentname" name="parentname" value={parentname} onChange={(event)=>ChangeMemberName(event.target.value)}>
      <option>
        --Members--
      </option>
      {employees.map((curele)=>{
        return (
        <option value={curele.id}>
        {curele.Name}
      </option>
        )
      })

}
      
    </select>
 </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" value={name} onChange={(event)=>SetName(event.target.value)}/>
  </div>
              <button   class="btn btn-primary mt-4"  onClick={save}>Register</button>
              <button   class="btn btn-warning mt-4"  onClick={update}>Update</button>
</form>


<table class="table table-dark" align="center">
  <thead>
    <tr>
      <th scope="col">Employee Id</th>
      <th scope="col">Employee Name</th>
      <th scope="col">Employee ParentId</th>
      
      
      <th scope="col">Option</th>
    </tr>
  </thead>
       {employees.map((employee)=>{
       
            return(
            <tbody>
                <tr>
                <th scope="row">{employee.id} </th>
                <td>{employee.Name}</td>
                <td>{employee.parentid}</td>
                <td>
                    <button type="button" class="btn btn-warning"  onClick={() => editEmployee(employee)} >Edit</button>  
                    <button type="button" class="btn btn-danger" onClick={() => DeleteEmployee(employee.id)}>Delete</button>
                </td>
                </tr>
            </tbody>
            );
            })}
            </table>


      </div>
    );
    
  }
  
  export default User;
  