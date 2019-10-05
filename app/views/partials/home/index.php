
<template id="Home">
    <div>
        
        <div  class="jumbotron mini">
            <div class="container-fluid">
                
                <div class="row ">
                    
                    <div  class="col-md-12 comp-grid" :class="setGridSize">
                        <div class="">
                            <h3>Dashboard</h3>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div  class="pb-2 mb-3 border-bottom">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-md-3 col-sm-4 col-6 comp-grid" :class="setGridSize">
                        
                    <recordcount animate="zoomIn" datapath="components/getcount_patients" title="Patients" desc="" link="/patients" icon='<i class="material-icons ">account_box</i>' :progressmax="100" displaystyle="card" variant="info"></recordcount>
                    
                </div>
                
                <div  class="col-md-3 col-sm-4 col-6 comp-grid" :class="setGridSize">
                    
                <recordcount animate="zoomIn" datapath="components/getcount_users" title="Users" desc="" link="/users" icon='<i class="material-icons ">account_circle</i>' :progressmax="100" displaystyle="card" variant="info"></recordcount>
                
            </div>
            
        </div>
    </div>
</div>

<div  class="pb-2 mb-3 border-bottom">
    <div class="container">
        
        <div class="row ">
            
            <div  class="col-md-12 comp-grid" :class="setGridSize">
                <div class=""><patients-list  headertitle="" emptyrecordmsg="No Record Found" :limit="20" fieldname="" fieldvalue="" sortby="" sorttype="DESC" :showheader="true" :addbutton="true" :editbutton="true" :viewbutton="true" :deletebutton="true" :exportbutton="true" :importbutton="true" :searchfield="true" :listsequence="true" :multicheckbox="true" :paginate="true"  :resetgrid="false" v-if="ready"></patients-list></div>
                
            </div>
            
        </div>
    </div>
</div>

</div>
</template>
<script>
    var HomeComponent = Vue.component('HomeComponent', {
    template : '#Home',
    props: {
    resetgrid : {
    type : Boolean,
    default : false,
    },
    },
    data : function() {
    return {
    loading : false,
    ready: false,
    }
    },
    computed: {
    setGridSize: function(){
    if(this.resetgrid){
    return 'col-sm-12 col-md-12 col-lg-12';
    }
    }
    },
    methods : {
    
    },
    mounted : function() {
    this.ready = true;
    },
    });
    
</script>

<style>
    
    /*  Component Style Goes Here */
    
    
</style>


