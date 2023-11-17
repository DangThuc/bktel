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
                     <label for="first-name">Name</label>
                     <input type="text" required class="form-control" id="name" v-model="form.name" placeholder="Name">
                   </div>
                   <div class="form-group">
                     <label for="last-name">Code</label>
                     <input type="text" required class="form-control" id="code" v-model="form.code" placeholder="Code">
                   </div>
                    <div class="form-group">
                     <label for="student-code">Note</label>
                     <input type="text" required class="form-control" id="note" v-model="form.note" placeholder="Note">
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
                 name: '',
                 code: '',
                 note: ''
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
