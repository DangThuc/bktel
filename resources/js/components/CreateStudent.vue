<template>
    <!-- general form elements -->
             <div class="card card-primary">
               <div class="card-header">
                 <h3 class="card-title">Please Fill & Click Submit</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               
               <div class="mb-3 row">
               <form @submit.prevent="submit">
                
                 <div class="card-body" >
                   <div class="form-group">
                     <label for="first-name">First Name</label>
                     <input type="text" required class="form-control" id="Firstname" v-model="form.Firstname" placeholder="First Name">
                   </div>
                   <div class="form-group">
                     <label for="last-name">Last Name</label>
                     <input type="text" required class="form-control" id="Lastname" v-model="form.Lastname" placeholder="Last Name">
                   </div>
                    <div class="form-group">
                     <label for="student-code">Student Code</label>
                     <input type="text" required class="form-control" id="Studentcode" v-model="form.Studentcode" placeholder="Student Code">
                   </div>
                     <div class="form-group">
                     <label for="department">Department</label>
                     <input type="text" required class="form-control" id="Department" v-model="form.Department" placeholder="Department">
                   </div>
                   <div class="form-group">
                     <label for="faculty">Faculty</label>
                     <input type="text" required class="form-control" id="Faculty" v-model="form.Faculty" placeholder="Faculty">
                   </div>
                   <div class="form-group">
                     <label for="address">Address</label>
                     <input type="text" required class="form-control" id="Address" v-model="form.Address" placeholder="Address">
                   </div>
                    <div class="form-group">
                     <label for="phone">Phone</label>
                     <input type="text" required class="form-control" id="Phone" v-model="form.Phone" placeholder="Phone">
                   </div>
                    <div class="form-group">
                     <label for="note">Note</label>
                     <input type="text" class="form-control" id="Note" v-model="form.Note" placeholder="Note">
                   </div>
                 </div>
                 <!-- /.card-body -->
 
                 <div class="card-footer">
                   <button type="submit" class="btn btn-primary">Submit</button>
                 </div>
               </form>
             </div>
            </div>
             <!-- /.card -->
 </template>
 <script>
     export default {
       data(){
         return{
             form: {
                 Firstname: '',
                 Lastname: '',
                 Studentcode: '',
                 Department: '',
                 Faculty: '',
                 Address: '',
                 Phone: '',
                 Note: ''
             }
         }
     },
         methods: {
        submit() {
       this.errors = {};
       axios.post('index',  this.form).then(response => {
        window.location.href = 'index'
       });
     }
   },
     }
 </script>
