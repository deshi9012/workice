+function ($) {
  $(function(){
    
    var intro = introJs();

    intro.setOptions({
      steps: [
      {
          element: '.nav-user',
          intro: '<h4 class="h4"><strong>User Profile</strong></h4><p>Use this section to change user profile, view running timers and power search</p>',
          position: 'bottom'
        },
        {
          element: '#nav header',
          intro: '<h4 class="h4"><strong>Quick Actions</strong></h4><p>Use this section to perform quick actions i.e Send Invites or quickly start a new project</p>',
          position: 'right'
        },
        {
          element: '#feeds',
          intro: '<h4 class="h4"><strong>Activity Feeds</strong></h4><p>Displays application activity feeds as they happen.</p>',
          position: 'left'
        }, 
        {
          element: '#todolist',
          intro: '<h4 class="h4"><strong>Schedules</strong></h4><p>Use this buttons to check your appointments and activities for this week .</p>',
          position: 'left'
        },       
        {
          element: '#changeLanguages',
          intro: '<h4 class="h4"><strong>Localization</strong></h4><p>Use the button to change Workice CRM to your preferred supported language.</p>',
          position: 'top'
        }
      ],
      showBullets: true,
      showStepNumbers: false
    });

    intro.start();

  });
}(jQuery);