<x-layout>
    <section id="section">
        <div class="container" id="container-user-detail">
            <div class="row gy-4 justify-content-center">
                <div class="users-photo col-5 col-md-5 col-lg-3">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default-avatar.png') }}" alt="Barista Image" class="rounded img-fluid">
                </div>
                <div class="users-desc col-6 col-md-5 col-lg-4 ml-4 text-center align-self-center">
                    
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                    

                    @if(auth()->check()) 
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('useredit.page', $user->username) }}" class="btn rounded">Edit</a>
                            <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display: inline;" class="delete-form" data-name="{{ $user->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn rounded delete-button">Delete</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function () {
                        let form = this.closest('.delete-form');
                        let userName = form.getAttribute('data-name');
        
                        Swal.fire({
                            title: "Are you sure?",
                            text: `You are about to delete ${userName}. This action cannot be undone!`,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "Cancel"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    </section>
</x-layout>