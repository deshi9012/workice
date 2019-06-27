<template>
  <ol class="dd-list activity-list">
<li class="dd-item dd3-item" v-for="task in todos">
  
  <span class="pull-right m-xs">
    <a href="" data-toggle="ajaxModal">
      {{ task.id }}
    </a>
    
    <a href="" data-toggle="ajaxModal">
      {{ task.name }}
    </a>
    
   
  </span>
  
  <div class="dd3-content">
    <label>
      <input type="checkbox" class="checkItem">
      <span class="label-text">
        <span class="text-semibold">
          {{ task.subject }} <small class="text-muted small m-l-sm">{{ task.due_date }}</small>
        </span>
      </span>
    </label>
    <p class="m-xs">task.notes</p>
    
  </div>

  
</li>

</ol>

    
</template>
<script>
    export default {
        directives: {
            'autofocus': {
                inserted(el) {
                    el.focus();
                }
            }
        },
        data() {
            return {
                message: 'Double click for editing.',
                list: [],
                task: {
                    id: '',
                    body: '',
                    archive: ''
                },
                editingTask: {},
                activeItem: 'current'
            }
        },
        created() {
            this.fetchTaskList();
        },
        methods: {
            fetchTaskList(archive = null) {
                if (archive === null) {
                    var url = '/api/activity';
                    this.setActive('current');
                } else {
                    var url = 'archived_tasks';
                    this.setActive('archive');
                }
                axios.get(url).then(result => {
                    this.list = result.data
                });
            },
            isActive(menuItem) {
                return this.activeItem === menuItem;
            },
            setActive(menuItem) {
                this.activeItem = menuItem;
            },
            createTask() {
                axios.post('create_task', this.task).then(result                        => {
                    this.task.body = '';
                    this.fetchTaskList();
                }).catch(err => {
                    console.log(err);
                });
            },
            editTask(task) {
                this.editingTask = task;
            },
            endEditing(task) {
                this.editingTask = {};
                if (task.body.trim() === '') {
                    this.deleteTask(task.id);
                } else {
                    axios.post('edit_task', task).then(result => {
                        console.log('access!')
                    }).catch(err => {
                        console.log(err);
                    });
                }
            },
            deleteTask(id) {
                axios.post('delete_task/' + id).then(result => {
                    this.fetchTaskList();
                }).catch(err => {
                    console.log(err);
                });
            },
            archiveTask(id) {
                axios.post('archive_task/' + id).then(result => {
                    this.fetchTaskList();
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>