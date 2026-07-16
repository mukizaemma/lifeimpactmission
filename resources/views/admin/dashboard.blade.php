<div class="ilm-admin-page">
<main>
            <div class="container-fluid px-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-4 mb-3">
                    <h1 class="mb-0">Recent Messages</h1>
                    @if($messages->count())
                        <button
                            type="button"
                            class="btn btn-danger"
                            wire:click="clearAllMessages"
                            wire:confirm="Delete ALL visitor messages? This cannot be undone."
                        >
                            <i class="fa fa-trash"></i> Clear all messages
                        </button>
                    @endif
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Recent Messages from Website visitors
                        <span class="badge bg-secondary ms-2">{{ $messages->count() }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date Done</th>
                                    <th>Names</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $rs)
                                <tr wire:key="message-{{ $rs->id }}">
                                    <td>{{ $rs->id }}</td>
                                    <td>{{ $rs->created_at }}</td>
                                    <td>{{ $rs->names }}</td>
                                    <td>{{ $rs->email }}</td>
                                    <td>{{ $rs->message }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('messageReply', $rs->id) }}" class="btn btn-primary" wire:navigate title="Reply">
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                            <button
                                                type="button"
                                                class="btn btn-warning"
                                                title="Delete"
                                                wire:click="deleteMessage({{ $rs->id }})"
                                                wire:confirm="Delete this message?"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No visitor messages yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
</div>
