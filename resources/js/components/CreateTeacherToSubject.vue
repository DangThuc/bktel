<template>
    <!-- general form elements -->
             <div class="card card-primary">
               <div class="card-header">
                 <h3 class="card-title">Please Fill & Click Submit</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <form @submit.prevent="submit">
                 <div class="card-body">
                   <div class="form-group">
                     <label for="first-name">TeacherId</label>
                     <input  type="text" required class="form-control" id="teacher_id" v-model="form.teacher_id" placeholder="TeacherId">
                   </div>
                   <div class="form-group">
                     <label for="last-name">SubjectId</label>
                     <input   type="text" required class="form-control" id="subject_id" v-model="form.subject_id" placeholder="SubjectId">
                   </div>
                    
                    <div class="form-group">
                     <label for="teacher-code">Semester</label>
                     <input type="text" required class="form-control" id="semester" v-model="form.semester" placeholder="Semester">
                   </div>
                     <div class="form-group">
                     <label for="department">Year</label>
                     <input type="text" required class="form-control" id="year" v-model="form.year" placeholder="Year">
                   </div>
                  
                  
                 </div>
                 <!-- /.card-body -->
 
                 <div class="card-footer">
                   <button type="submit" class="btn btn-primary">Submit</button>
                 </div>
               </form>
             </div>
             <!-- /.card -->
 </template>
 <script>
     export default {
       data(){
         return{
             form: {
                 teacher_id: '',
                 subject_id: '',
                 semester: '',
                 year: '',
                 
             },
             teachers :{},
             subjects :{}
         }
     },
    methods: {
        submit() {
            this.errors = {};
            axios.post('index',  this.form).then(response => {
            //window.location.href = 'index'
            console.log(response);
            });
        },
        
        
        async getTeacher(){
            const { teachers } = await axios.get("http://127.0.0.1:8000/api/teachers");
            this.teachers = teachers;
            console.log(teachers);
        },
        async getSubject(){
            const { subjects } = await axios.get("http://127.0.0.1:8000/api/subjects");
            this.subjects = subjects;
            console.log(subjects);
        }
   },
     }
 </script>