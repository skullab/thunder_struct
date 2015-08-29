$(document).ready(function() {
	$('#PersonTableContainer').jtable({
		title : 'Users',
		paging: true,
        sorting: true,
        defaultSorting: 'name ASC',
        selecting: true, //Enable selecting
        multiselect: true, //Allow multiple selecting
        selectingCheckboxes: true, //Show checkboxes on first column
        //selectOnRowClick: false, //Enable this to only select using checkboxes
		actions : {
			listAction : '/thunder_struct_new/users/load',
			createAction : '/thunder_struct_new/users/create',
			updateAction : '/thunder_struct_new/users/update',
			deleteAction : '/thunder_struct_new/users/delete'
		},
		fields : {
			id : {
				title:'ID',
				width: '10%',
				key : true,
				list : true
			},
			name : {
				title : 'Name',
				width : '40%'
			},
			password : {
				title : 'Password',
				width : '50%'
			},
		}
	});
	
	 $('#LoadRecordsButton').click(function (e) {
         e.preventDefault();
         $('#PersonTableContainer').jtable('load', {
             name: $('#name').val()
         });
     });

	$('#PersonTableContainer').jtable('load');
});

