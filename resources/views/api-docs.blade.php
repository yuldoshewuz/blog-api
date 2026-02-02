<!DOCTYPE html>
<html lang="en" class="scroll-pt-20">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }

        pre, code {
            font-family: 'JetBrains Mono', monospace;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
            z-index: 50;
        }

        .main-content {
            margin-left: 280px;
            max-width: 1400px;
        }

        .nav-group-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 24px 0 8px 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            font-size: 0.875rem;
            color: #4b5563;
            border-radius: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #f9fafb;
            color: #111827;
        }

        .nav-link.active {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 600;
        }

        .badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            min-width: 45px;
            text-align: center;
        }

        .post {
            background: #dbeafe;
            color: #1e40af;
        }

        .get {
            background: #d1fae5;
            color: #065f46;
        }

        .put {
            background: #fef3c7;
            color: #92400e;
        }

        .delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .api-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 60px 40px;
            border-bottom: 1px solid #e5e7eb;
        }

        .api-details {
            min-width: 0;
        }

        .api-code {
            position: sticky;
            top: 40px;
            align-self: start;
            min-width: 0;
        }

        .param-table {
            width: 100%;
            font-size: 0.875rem;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .param-table th {
            text-align: left;
            padding: 8px 0;
            color: #6b7280;
            font-weight: 500;
            border-bottom: 1px solid #e5e7eb;
        }

        .param-table td {
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            vertical-align: top;
        }

        .param-name {
            font-family: 'JetBrains Mono', monospace;
            color: #2563eb;
            font-weight: 500;
        }

        .param-type {
            font-size: 0.75rem;
            color: #9ca3af;
            font-family: 'JetBrains Mono', monospace;
        }

        .req {
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 4px;
        }

        .code-window {
            background: #0f172a;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid #1e293b;
        }

        .code-header {
            background: #1e293b;
            padding: 10px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #334155;
        }

        .code-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .code-body {
            padding: 20px;
            overflow-x: auto;
            color: #e2e8f0;
            font-size: 0.8125rem;
            line-height: 1.6;
        }

        .j-key {
            color: #7dd3fc;
        }

        .j-str {
            color: #a5f3fc;
        }

        .j-num {
            color: #fcd34d;
        }

        .j-bool {
            color: #f9a8d4;
        }

        .j-null {
            color: #94a3b8;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .api-section {
                grid-template-columns: 1fr;
                gap: 24px;
                padding: 40px 20px;
            }

            .api-code {
                position: static;
            }
        }
    </style>
</head>
<body>

<div class="lg:hidden sticky top-0 bg-white border-b z-40 px-4 py-3 flex justify-between items-center">
    <span class="font-bold text-lg">Blog API Docs</span>
    <button onclick="toggleMenu()" class="text-gray-500"><i class="fa-solid fa-bars fa-lg"></i></button>
</div>

<aside id="sidebar" class="sidebar">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold italic">B
            </div>
            <div>
                <h1 class="font-bold text-gray-900 text-sm">Blog API</h1>
                <p class="text-xs text-gray-500">Documentation</p>
            </div>
        </div>
    </div>

    <nav class="p-4">
        <div class="nav-group-title">Getting Started</div>
        <a href="#intro" class="nav-link active"><i class="fa-solid fa-book w-5 text-center"></i> Introduction</a>

        <div class="nav-group-title">Authentication</div>
        <a href="#register" class="nav-link"><span class="badge post">POST</span> Register</a>
        <a href="#login" class="nav-link"><span class="badge post">POST</span> Login</a>
        <a href="#user" class="nav-link"><span class="badge get">GET</span> Current User</a>
        <a href="#email-notification" class="nav-link"><span class="badge post">POST</span> Verify Notification</a>
        <a href="#email-verify" class="nav-link"><span class="badge get">GET</span> Verify Email</a>
        <a href="#forgot-password" class="nav-link"><span class="badge post">POST</span> Forgot Password</a>
        <a href="#reset-password" class="nav-link"><span class="badge post">POST</span> Reset Password</a>
        <a href="#password" class="nav-link"><span class="badge put">PUT</span> Update Password</a>
        <a href="#logout" class="nav-link"><span class="badge post">POST</span> Logout</a>
        <a href="#delete" class="nav-link"><span class="badge delete">DEL</span> Delete Account</a>
        <a href="#users-list" class="nav-link"><span class="badge get">GET</span> Users List</a>

        <div class="nav-group-title">Category Management</div>
        <a href="#cat-list" class="nav-link"><span class="badge get">GET</span> List Categories</a>
        <a href="#cat-show" class="nav-link"><span class="badge get">GET</span> Single Category</a>
        <a href="#cat-create" class="nav-link"><span class="badge post">POST</span> Create Category</a>
        <a href="#cat-update" class="nav-link"><span class="badge put">PUT</span> Update Category</a>
        <a href="#cat-delete" class="nav-link"><span class="badge delete">DEL</span> Delete Category</a>

        <div class="nav-group-title">Blog Management</div>
        <a href="#post-list" class="nav-link"><span class="badge get">GET</span> List Posts</a>
        <a href="#post-admin" class="nav-link"><span class="badge get">GET</span> Admin Posts</a>
        <a href="#post-show" class="nav-link"><span class="badge get">GET</span> Single Post</a>
        <a href="#post-create" class="nav-link"><span class="badge post">POST</span> Create Post</a>
        <a href="#post-update" class="nav-link"><span class="badge put">PUT</span> Update Post</a>
        <a href="#post-delete" class="nav-link"><span class="badge delete">DEL</span> Delete Post</a>

        <div class="nav-group-title">Comment Management</div>
        <a href="#comment-list" class="nav-link"><span class="badge get">GET</span> List Comments</a>
        <a href="#comment-create" class="nav-link"><span class="badge post">POST</span> Post Comment</a>
        <a href="#comment-update" class="nav-link"><span class="badge put">PUT</span> Edit Comment</a>
        <a href="#comment-delete" class="nav-link"><span class="badge delete">DEL</span> Delete Comment</a>

        <div class="nav-group-title">Like Management</div>
        <a href="#like-toggle" class="nav-link"><span class="badge post">POST</span> Toggle Like</a>
        <a href="#like-favorites" class="nav-link"><span class="badge get">GET</span> My Favorites</a>
    </nav>
</aside>

<main class="main-content">
    <section id="intro" class="api-section">
        <div class="api-details">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Introduction</h1>
            <p class="text-gray-600 leading-relaxed mb-6">
                Welcome to the Blog API. All responses are returned in JSON format.
                Authentication is handled via Laravel Sanctum Bearer tokens.
            </p>

            <div class="flex flex-wrap gap-3 mb-8">
                <a href="https://github.com/yuldoshewuz/blog-api" target="_blank"
                   class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-md text-sm font-medium hover:bg-gray-800 transition-all shadow-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    GitHub
                </a>
                <a href="https://yuldoshew.uz" target="_blank"
                   class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-md text-sm font-medium hover:border-indigo-500 hover:text-indigo-600 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Developer
                </a>
            </div>

            <div class="mb-8 p-5 bg-indigo-50 border border-indigo-100 rounded-xl shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-1.5 bg-indigo-500 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-indigo-900 uppercase tracking-tight">Demo Accounts</h3>
                </div>

                <p class="text-xs text-indigo-700/80 mb-4 leading-relaxed">
                    After running <code class="bg-indigo-200/50 px-1 rounded text-indigo-800 font-bold">php artisan
                        migrate --seed</code>,
                    you can use these pre-defined accounts to test the API permissions and features.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-white/60 p-4 rounded-lg border border-indigo-200/50 hover:bg-white transition-colors">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            <span
                                class="text-[10px] font-black text-red-600 uppercase tracking-tighter">Admin Access</span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Email:</span> <span
                                    class="font-bold">admin@example.com</span>
                            </p>
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Pass:</span> <span class="font-bold italic text-indigo-600">password</span>
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white/60 p-4 rounded-lg border border-indigo-200/50 hover:bg-white transition-colors">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span
                                class="text-[10px] font-black text-emerald-600 uppercase tracking-tighter">User Access</span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Email:</span> <span
                                    class="font-bold">user@example.com</span>
                            </p>
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Pass:</span> <span class="font-bold italic text-indigo-600">password</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                <h3 class="text-sm font-bold text-blue-800 mb-1">Base URL</h3>
                <code class="text-blue-600 font-mono text-sm tracking-tight">{{ url('/api') }}</code>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <h3 class="text-sm font-bold text-gray-800 mb-2">Standard Response Format</h3>
                <p class="text-xs text-gray-500 mb-3 italic">Used by <code>BaseController</code></p>
                <pre
                    class="bg-slate-50 p-4 rounded text-[11px] text-slate-700 border border-slate-100 overflow-x-auto font-mono leading-relaxed">{
  <span class="text-indigo-600">"status"</span>: <span class="text-emerald-600">"success"</span>,
  <span class="text-indigo-600">"status_code"</span>: <span class="text-blue-600">200</span>,
  <span class="text-indigo-600">"message"</span>: <span class="text-emerald-600">"Operation successful."</span>,
  <span class="text-indigo-600">"data"</span>: { ... },
  <span class="text-indigo-600">"error_note"</span>: <span class="text-gray-400">null</span>
}</pre>
            </div>
        </div>
        <div class="api-code hidden lg:block border-l border-gray-50"></div>
    </section>

    <section id="register" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Register User</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/register</code>
            <p class="text-gray-600 text-sm mb-6">Creates a new user account and returns an access token.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">name</span><span class="req">*</span></td>
                    <td width="20%"><span class="param-type">string</span></td>
                    <td>User's full name. Max 255 chars.</td>
                </tr>
                <tr>
                    <td><span class="param-name">email</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Must be a valid email and unique in database.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Min 8 chars. Must be confirmed.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password_confirmation</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Must match the password field exactly.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">201 Created</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">201</span>,
  <span class="j-key">"message"</span>: <span
        class="j-str">"User registered successfully. Please verify your email."</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"user"</span>: {
      <span class="j-key">"name"</span>: <span class="j-str">"John Doe"</span>,
      <span class="j-key">"email"</span>: <span class="j-str">"john@example.com"</span>,
      <span class="j-key">"role"</span>: <span class="j-str">"user"</span>,
      <span class="j-key">"id"</span>: <span class="j-num">1</span>
    },
    <span class="j-key">"token"</span>: <span class="j-str">"1|AbCdEf..."</span>
  },
  <span class="j-key">"error_note"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">400 Bad Request</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">400</span>,
  <span class="j-key">"error_message"</span>: <span class="j-str">"Registration failed."</span>,
  <span class="j-key">"error_note"</span>: <span class="j-str">"Validation error or database issue."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="login" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Login</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/login</code>
            <p class="text-gray-600 text-sm mb-6">Authenticate user and create a new API token.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">email</span><span class="req">*</span></td>
                    <td width="20%"><span class="param-type">string</span></td>
                    <td>Valid user email.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>User password.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"User logged in successfully."</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"user"</span>: { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"John"</span> },
    <span class="j-key">"token"</span>: <span class="j-str">"2|Zxy..."</span>
  }
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">401 Unauthorized</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">401</span>,
  <span class="j-key">"error_message"</span>: <span class="j-str">"Unauthorized."</span>,
  <span class="j-key">"errors"</span>: {
    <span class="j-key">"email"</span>: <span class="j-str">"Invalid credentials."</span>
  },
  <span class="j-key">"error_note"</span>: <span class="j-str">"Credentials mismatch."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="user" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">Current User</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/user</code>
            <div class="mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
            </div>
            <p class="text-gray-600 text-sm">Retrieve the authenticated user's profile information.</p>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"User profile retrieved."</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"John Doe"</span>,
    <span class="j-key">"email"</span>: <span class="j-str">"john@example.com"</span>,
    <span class="j-key">"role"</span>: <span class="j-str">"user"</span>,
    <span class="j-key">"created_at"</span>: <span class="j-str">"2024-01-01..."</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="email-notification" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Resend Verification</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/email/verification-notification</code>
            <div class="mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Sends a new email verification link to the authenticated user. If the
                email is already verified, it returns a 400 error.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <p class="text-sm text-gray-500 mt-2 italic">No parameters required. The user is identified via the Bearer
                Token.</p>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Verification link sent."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>,
  <span class="j-key">"error_note"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">400 Bad Request</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">400</span>,
  <span class="j-key">"error_message"</span>: <span class="j-str">"Already verified."</span>,
  <span class="j-key">"error_note"</span>: <span class="j-str">"Email already verified."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="email-verify" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">Verify Email</h2>
            </div>
            <code
                class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/email/verify/{id}/{hash}</code>
            <div class="mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Validates the user's email address using the ID and hash provided in
                the verification link.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">URL Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">id</span><span class="req">*</span></td>
                    <td width="20%"><span class="param-type">integer</span></td>
                    <td>The unique ID of the user.</td>
                </tr>
                <tr>
                    <td><span class="param-name">hash</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>The verification hash sent to the user's email.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Email verified successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-blue-400">200 OK (Informational)</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Email already verified."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="forgot-password" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Forgot Password</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/forgot-password</code>
            <p class="text-gray-600 text-sm mb-6">Sends a password reset link to the user's email address if it exists
                in our system.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">email</span><span class="req">*</span></td>
                    <td width="20%"><span class="param-type">string</span></td>
                    <td>Registered user email address. Must be a valid email.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Reset link sent to your email."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>,
  <span class="j-key">"error_note"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">400 Bad Request</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">400</span>,
  <span class="j-key">"error_message"</span>: <span class="j-str">"Failed."</span>,
  <span class="j-key">"error_note"</span>: <span class="j-str">"Email not found or error occurred."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="reset-password" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Reset Password</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/reset-password</code>
            <p class="text-gray-600 text-sm mb-6">Updates the user's password using the token received via email.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">token</span><span class="req">*</span></td>
                    <td width="20%"><span class="param-type">string</span></td>
                    <td>The reset token received in the email.</td>
                </tr>
                <tr>
                    <td><span class="param-name">email</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>User's email address.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>New password. Min 8 chars, must be confirmed.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password_confirmation</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Must match the password field.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Password reset successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">400 Bad Request</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">400</span>,
  <span class="j-key">"error_message"</span>: <span class="j-str">"Reset failed."</span>,
  <span class="j-key">"error_note"</span>: <span class="j-str">"Invalid token or email."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="password" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge put">PUT</span>
                <h2 class="text-2xl font-bold text-gray-900">Update Password</h2>
            </div>
            <code
                class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/user/password-update</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
                <span class="bg-yellow-600 text-white text-[10px] font-bold px-2 py-1 rounded">VERIFIED</span>
            </div>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="35%"><span class="param-name">current_password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Must match the user's current password.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>New password. Min 8 chars.</td>
                </tr>
                <tr>
                    <td><span class="param-name">password_confirmation</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Must confirm new password.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Password updated successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">422 Unprocessable</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"message"</span>: <span class="j-str">"The current password is incorrect."</span>,
  <span class="j-key">"errors"</span>: {
    <span class="j-key">"current_password"</span>: [
       <span class="j-str">"The current password is incorrect."</span>
    ]
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="logout" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Logout</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/logout</code>
            <div class="mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
            </div>
            <p class="text-gray-600 text-sm">Revokes the current access token. User must login again to access protected
                resources.</p>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Logged out successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="delete" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold text-gray-900">Delete Account</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/user/delete</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
                <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">DANGER</span>
            </div>
            <p class="text-gray-600 text-sm">Permanently deletes the user record and all associated data/tokens. This
                action cannot be undone.</p>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Account deleted successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="users-list" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">Users List</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/users-list</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
                <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span>
            </div>
            <p class="text-gray-600 text-sm mb-4">Retrieves a paginated list of all registered users.</p>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-xs text-yellow-700">Requires <code>admin</code> middleware. Standard users will receive a
                    403 Forbidden response.</p>
            </div>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Users list retrieved."</span>,
  <span class="j-key">"data"</span>: [
    { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span class="j-key">"name"</span>: <span
        class="j-str">"Admin"</span>, <span class="j-key">"role"</span>: <span class="j-str">"admin"</span> },
    { <span class="j-key">"id"</span>: <span class="j-num">2</span>, <span class="j-key">"name"</span>: <span
        class="j-str">"User"</span>, <span class="j-key">"role"</span>: <span class="j-str">"user"</span> }
  ],
  <span class="j-key">"links"</span>: { ... },
  <span class="j-key">"meta"</span>: { ... }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="cat-list" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">List Categories</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/categories</code>
            <div class="mb-6">
                <span
                    class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded border border-emerald-200">PUBLIC</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Fetch all categories. This is a public endpoint used for navigation or
                filtering posts.</p>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Categories retrieved successfully."</span>,
  <span class="j-key">"data"</span>: [
    { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span class="j-key">"name"</span>: <span
        class="j-str">"Tech"</span>, <span class="j-key">"slug"</span>: <span class="j-str">"tech"</span> },
    { <span class="j-key">"id"</span>: <span class="j-num">2</span>, <span class="j-key">"name"</span>: <span
        class="j-str">"Design"</span>, <span class="j-key">"slug"</span>: <span class="j-str">"design"</span> }
  ]
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="cat-show" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">Single Category</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/categories/{id}</code>
            <p class="text-gray-600 text-sm mb-6">Retrieve detailed information about a specific category by its ID.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Path Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">id</span><span class="req">*</span></td>
                    <td><span class="param-type">integer</span></td>
                    <td>The unique identifier of the category.</td>
                </tr>
            </table>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Category details."</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"Tech"</span>,
    <span class="j-key">"slug"</span>: <span class="j-str">"tech"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="cat-create" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Create Category</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/categories</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH</span>
                <span class="bg-yellow-600 text-white text-[10px] font-bold px-2 py-1 rounded">VERIFIED</span>
                <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN</span>
            </div>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">name</span><span class="req">*</span></td>
                    <td width="20%"><span class="param-type">string</span></td>
                    <td>The name of the category. Must be unique.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-4">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">201</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Category created successfully."</span>,
  <span class="j-key">"data"</span>: { <span class="j-key">"id"</span>: <span class="j-num">3</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"AI"</span> }
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header"><span class="code-title text-red-400">403 Forbidden</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">403</span>,
  <span class="j-key">"error_message"</span>: <span class="j-str">"Access Denied."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="cat-update" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge put">PUT</span>
                <h2 class="text-2xl font-bold text-gray-900">Update Category</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/categories/{id}</code>
            <div class="mb-6"><span
                    class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span></div>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">name</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>New category name.</td>
                </tr>
            </table>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Category updated."</span>,
  <span class="j-key">"data"</span>: { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"Updated Tech"</span> }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="cat-delete" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold text-gray-900">Delete Category</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/categories/{id}</code>
            <div class="mb-6"><span
                    class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span></div>
            <p class="text-gray-600 text-sm">Permanently deletes the category.</p>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Category deleted successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="post-list" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">List Posts</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts</code>
            <div class="mb-6"><span
                    class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded border border-emerald-200">PUBLIC ACCESS</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Returns only **published** posts with pagination. Includes user,
                category info, and like counts.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Query Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">per_page</span></td>
                    <td><span class="param-type">int</span></td>
                    <td>Results per page (Default: 10).</td>
                </tr>
                <tr>
                    <td><span class="param-name">search</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Search in title or body content.</td>
                </tr>
                <tr>
                    <td><span class="param-name">category_id</span></td>
                    <td><span class="param-type">int</span></td>
                    <td>Filter posts by a specific category.</td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"current_page"</span>: <span class="j-num">1</span>,
    <span class="j-key">"data"</span>: [
      {
        <span class="j-key">"id"</span>: <span class="j-num">1</span>,
        <span class="j-key">"title"</span>: <span class="j-str">"Post Title"</span>,
        <span class="j-key">"likes_count"</span>: <span class="j-num">5</span>,
        <span class="j-key">"user"</span>: { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"Admin"</span> },
        <span class="j-key">"category"</span>: { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"Tech"</span> }
      }
    ]
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="post-admin" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">Admin All Posts</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts_all</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Administrative endpoint to view all posts, including **drafts**.
                Supports the same filters as the public index.</p>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><span class="text-xs text-gray-400">// Returns full paginated list including drafts</span>
                </div>
            </div>
        </div>
    </section>

    <section id="post-show" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">Single Post Details</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts/{id}</code>
            <div class="mb-6">
                <span
                    class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded border border-emerald-200">PUBLIC ACCESS</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Retrieves full details of a specific post. Accessing this endpoint
                automatically increments the <code>views_count</code> field.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Path Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">id</span><span class="req">*</span></td>
                    <td><span class="param-type">integer</span>/<span>slug</span></td>
                    <td>The unique ID of the post to retrieve.</td>
                </tr>
            </table>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2 mt-6">Includes
                (Relationships)</h3>
            <p class="text-gray-500 text-[12px] mt-2 italic">This endpoint automatically returns the following nested
                objects:</p>
            <ul class="list-disc ml-5 mt-2 text-xs text-gray-600 space-y-1">
                <li><strong>user:</strong> The author's basic profile.</li>
                <li><strong>category:</strong> The category the post belongs to.</li>
                <li><strong>comments:</strong> All comments associated with this post.</li>
            </ul>
        </div>

        <div class="api-code space-y-6">
            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-emerald-400">200 OK</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Post details retrieved."</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"title"</span>: <span class="j-str">"Mastering Laravel APIs"</span>,
    <span class="j-key">"body"</span>: <span class="j-str">"Full post content here..."</span>,
    <span class="j-key">"views_count"</span>: <span class="j-num">154</span>,
    <span class="j-key">"user"</span>: { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"Admin"</span> },
    <span class="j-key">"category"</span>: { <span class="j-key">"id"</span>: <span class="j-num">2</span>, <span
        class="j-key">"name"</span>: <span class="j-str">"Backend"</span> },
    <span class="j-key">"comments"</span>: [...]
  }
}</pre>
                </div>
            </div>

            <div class="code-window">
                <div class="code-header">
                    <span class="code-title text-red-400">404 Not Found</span>
                </div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"error"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Post not found!"</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="post-create" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Create Post</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts</code>
            <div class="mb-6"><span
                    class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span></div>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Request Body
                (Multipart/Form-Data)</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">category_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                    <td>Must exist in categories table.</td>
                </tr>
                <tr>
                    <td><span class="param-name">title</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Maximum 255 characters.</td>
                </tr>
                <tr>
                    <td><span class="param-name">body</span><span class="req">*</span></td>
                    <td><span class="param-type">text</span></td>
                    <td>The main content of the post.</td>
                </tr>
                <tr>
                    <td><span class="param-name">image</span></td>
                    <td><span class="param-type">file</span></td>
                    <td>JPG, JPEG, PNG (Max: 4MB).</td>
                </tr>
                <tr>
                    <td><span class="param-name">status</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Choices: <code>draft</code>, <code>published</code>.</td>
                </tr>
            </table>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">201</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">10</span>,
    <span class="j-key">"title"</span>: <span class="j-str">"How to use Laravel"</span>,
    <span class="j-key">"image"</span>: <span class="j-str">"posts/filename.jpg"</span>,
    <span class="j-key">"user_id"</span>: <span class="j-num">1</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="post-update" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge put">PUT</span>
                <h2 class="text-2xl font-bold text-gray-900">Update Post</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts/{id}</code>
            <div class="mb-6"><span
                    class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span></div>
            <p class="text-gray-600 text-sm mb-4">Updates post details and automatically generates a new slug if the
                title is changed. Replaces existing image if a new one is provided.</p>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-3 mb-6">
                <p class="text-[11px] text-amber-800"><strong>Pro-Tip:</strong> PHP/Laravel sometimes struggles with
                    <code>multipart/form-data</code> on <code>PUT</code> requests. Use <code>POST</code> and add <code>_method:
                        PUT</code> to your body fields.</p>
            </div>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Post updated successfully."</span>,
  <span class="j-key">"data"</span>: { <span class="j-key">"slug"</span>: <span
        class="j-str">"new-generated-slug"</span> }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="post-delete" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold text-gray-900">Delete Post</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts/{id}</code>
            <div class="mb-6"><span
                    class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">ADMIN ONLY</span></div>
            <p class="text-gray-600 text-sm">Deletes post and permanently removes the associated image file from
                disk.</p>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Post deleted successfully."</span>,
  <span class="j-key">"data"</span>: []
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="comment-list" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">List Comments</h2>
            </div>
            <code
                class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts/{postId}/comments</code>
            <div class="mb-6"><span
                    class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded border border-emerald-200">PUBLIC</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Fetch all comments associated with a specific post. Usually includes
                user profiles for display.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Path Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">postId</span><span class="req">*</span></td>
                    <td><span class="param-type">integer</span></td>
                    <td>The ID of the parent post.</td>
                </tr>
            </table>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"data"</span>: [
    {
      <span class="j-key">"id"</span>: <span class="j-num">1</span>,
      <span class="j-key">"body"</span>: <span class="j-str">"Great post! Thanks for sharing."</span>,
      <span class="j-key">"user"</span>: { <span class="j-key">"name"</span>: <span class="j-str">"John Doe"</span> },
      <span class="j-key">"created_at"</span>: <span class="j-str">"2024-05-20..."</span>
    }
  ]
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="comment-create" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Post Comment</h2>
            </div>
            <code
                class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts/{postId}/comments</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH</span>
                <span class="bg-yellow-600 text-white text-[10px] font-bold px-2 py-1 rounded">VERIFIED</span>
            </div>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">body</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>The content of the comment.</td>
                </tr>
            </table>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Comment added."</span>,
  <span class="j-key">"data"</span>: { <span class="j-key">"id"</span>: <span class="j-num">5</span>, <span
        class="j-key">"body"</span>: <span class="j-str">"Hello world"</span> }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="comment-update" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge put">PUT</span>
                <h2 class="text-2xl font-bold text-gray-900">Edit Comment</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/comments/{comment}</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">OWNER ONLY</span>
            </div>
            <p class="text-gray-600 text-sm mb-4">Updates the body of an existing comment. Requires the user to be the
                original author.</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Body Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">body</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Updated content.</td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><span class="text-xs text-gray-400">// Returns updated comment data</span></div>
            </div>
        </div>
    </section>

    <section id="comment-delete" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold text-gray-900">Delete Comment</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/comments/{comment}</code>
            <p class="text-gray-600 text-sm">Permanently removes the comment. Authorized for owners and
                administrators.</p>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Comment deleted."</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="like-toggle" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge post">POST</span>
                <h2 class="text-2xl font-bold text-gray-900">Toggle Like</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/posts/{post}/like</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH</span>
                <span class="bg-yellow-600 text-white text-[10px] font-bold px-2 py-1 rounded">VERIFIED</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">This is a dynamic endpoint. If the user has not liked the post, it
                will create a "Like". If they have already liked it, the "Like" will be removed (Unlike).</p>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Path Parameters</h3>
            <table class="param-table">
                <tr>
                    <td width="30%"><span class="param-name">post</span><span class="req">*</span></td>
                    <td><span class="param-type">integer</span></td>
                    <td>The unique ID of the post.</td>
                </tr>
            </table>
        </div>

        <div class="api-code space-y-4">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK (Liked)</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Post liked."</span>,
  <span class="j-key">"data"</span>: { <span class="j-key">"liked"</span>: <span class="j-bool">true</span> }
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header"><span class="code-title text-blue-400">200 OK (Unliked)</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Post unliked."</span>,
  <span class="j-key">"data"</span>: { <span class="j-key">"liked"</span>: <span class="j-bool">false</span> }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="like-favorites" class="api-section" style="border-bottom: none;">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4">
                <span class="badge get">GET</span>
                <h2 class="text-2xl font-bold text-gray-900">My Favorites</h2>
            </div>
            <code class="block bg-gray-100 p-2 rounded text-sm text-gray-600 mb-6 font-mono">/my-favorites</code>
            <div class="flex gap-2 mb-6">
                <span class="bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">AUTH REQUIRED</span>
            </div>
            <p class="text-gray-600 text-sm mb-6">Returns a paginated list of posts that the currently authenticated
                user has liked.</p>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body">
<pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"data"</span>: [
    {
      <span class="j-key">"id"</span>: <span class="j-num">12</span>,
      <span class="j-key">"title"</span>: <span class="j-str">"A post I liked earlier"</span>,
      <span class="j-key">"created_at"</span>: <span class="j-str">"2024-06-01"</span>
    }
  ]
}</pre>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-12 border-t border-gray-200 text-gray-400 text-sm">
        <div class="flex flex-col items-center gap-3">
            <p>Blog API &copy; {{ date('Y') }}</p>

            <div class="flex items-center gap-4 text-xs tracking-wide">
                <a href="https://github.com/yuldoshewuz/blog-api" target="_blank"
                   class="hover:text-gray-900 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    GITHUB
                </a>
                <span class="text-gray-200">|</span>
                <a href="https://yuldoshew.uz" target="_blank"
                   class="hover:text-indigo-500 transition-colors uppercase">
                    Developer
                </a>
            </div>
        </div>
    </footer>
</main>

<script>
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('open');
    }

    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (pageYOffset >= sectionTop - 100) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });
    });
</script>
</body>
</html>
