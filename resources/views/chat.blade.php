@push('styles')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/chat.js') }}"></script>
@endpush

<x-app-layout>
    <div style="height: 70vh" x-data="{}">
        <section class="msger mx-auto">
            <div class="msger-header">
                <div class="msger-header-title">
                    <i class="fas fa-comment-alt"></i>
                    <span class="chatWith"></span>
                    <span class="typing" style="display: none;"> está escribiendo</span>
                </div>
                <div class="msger-header-options">
                    <span class="chatStatus offline"><i class="fas fa-globe"></i></span>
                </div>
            </div>

            <div class="msger-chat">

            </div>

            <form class="msger-inputarea" id="form-send" @submit.prevent="send_message">
                <input type="text" class="msger-input" placeholder="Enter your message...">
                <button type="submit" class="msger-send-btn">Send</button>
            </form>

        </section>
    </div>
</x-app-layout>
