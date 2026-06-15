<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TMS | Manage Users</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 min-h-screen">
	<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
		@if (session('success'))
			<div class="rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 text-sm">
				{{ session('success') }}
			</div>
		@endif

		@if ($errors->any())
			<div class="rounded-xl bg-red-50 text-red-600 border border-red-200 px-4 py-3 text-sm space-y-1">
				@foreach ($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif

		<section class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
			<h1 class="text-3xl font-extrabold text-darkSlate">Manage Users</h1>
			<p class="text-slateGray mt-1">Edit roles and account status.</p>
		</section>

		<section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
			<div class="overflow-x-auto">
				<table class="min-w-full text-sm">
					<thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-slateGray">
						<tr>
							<th class="px-4 py-3">Name</th>
							<th class="px-4 py-3">Email</th>
							<th class="px-4 py-3">Role</th>
							<th class="px-4 py-3">Active</th>
							<th class="px-4 py-3">Actions</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-100">
						@forelse($users as $user)
							<tr>
								<td class="px-4 py-4 font-semibold text-darkSlate">{{ $user->first_name }} {{ $user->last_name }}</td>
								<td class="px-4 py-4">{{ $user->email }}</td>
								<td class="px-4 py-4">{{ $user->role_id == 1 ? 'Admin' : 'Client' }}</td>
								<td class="px-4 py-4">{{ $user->is_active ? 'Yes' : 'No' }}</td>
								<td class="px-4 py-4 space-x-3">
									<a class="font-semibold text-softMutedTeal" href="{{ route('admin.users.edit', $user) }}">Edit</a>
									<form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
										@csrf
										@method('DELETE')
										<button class="font-semibold text-crimson" onclick="return confirm('Delete this user?')">Delete</button>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td class="px-4 py-8 text-slateGray" colspan="5">No users found.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</section>
	</main>
</body>
</html>