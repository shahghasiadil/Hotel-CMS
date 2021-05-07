<!DOCTYPE html>
<html lang="en">
    @include('admin._head')
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper" id="app">
		
			@include('admin._header')
			
		
			@include('admin._sidebar')
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<router-view></router-view>
					<br>
					<div class="footer">
						<p class="text-center">&copy; 2021 All rights reserved to Shahghasi Adil</a></p>
					</div>
				</div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
        
        @include('admin._footer')
		@auth
			<script>
				window.user = @json(auth()->user())	
			</script>	
		@endauth
</script>
	
    </body>
</html>