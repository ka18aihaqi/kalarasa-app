@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

<x-layout>
    <!-- start-content -->
    <section id="home-section">
        <div class="container" id="home-container">
            <div class="title col12 text-center">
                <h1 class="text-title">Kala Rasa</h1>
                <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
            </div>
        </div>
    </section>
    <!-- end-content -->
</x-layout>