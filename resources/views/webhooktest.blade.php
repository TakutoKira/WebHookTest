<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Google Chat Webhook Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Google Chat Webhook Test</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('webhook.send') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">メッセージ</label>
                                <input type="text" class="form-control" id="message" name="message" required
                                    placeholder="メッセージを入力">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>

                        @if (session('result'))
                            <div class="mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>結果</h5>
                                    </div>
                                    <div class="card-body">
                                        <pre class="bg-light p-3 rounded {{ session('result.success') ? '' : 'text-danger' }}">
{{ session('result.message') }}
                                    </pre>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
