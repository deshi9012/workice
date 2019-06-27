<script>
  var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        authEndpoint: '/broadcasting/auth',
          auth: {
            headers: {
              'X-CSRF-Token': "{{ csrf_token() }}"
            }
          },
      cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
      encrypted: true
    });
      var channel = pusher.subscribe('private-workice-user-{{ Auth::id() }}');
      channel.bind('workice.event', function(data) {
        toastr.info( data.message , 'Hi, {{ Auth::user()->name }}');
        pusherCallback(data);
      });
      function pusherCallback(data){};
</script>