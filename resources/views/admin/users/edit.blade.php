<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TMS | Edit User</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 min-h-screen">
	<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
		<section class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
			<h1 class="text-3xl font-extrabold text-darkSlate">Edit User</h1>
			<p class="text-slateGray mt-1">Update account details and role.</p>
		</section>

		<section class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
			<form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
				@csrf
				@method('PUT')

				<div class="grid gap-4 md:grid-cols-2">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
						<input name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full rounded-lg border-gray-300">
					</div>

					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
						<input name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full rounded-lg border-gray-300">
					</div>

					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
						<input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300">
					</div>

					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
						<select name="role_id" class="w-full rounded-lg border-gray-300">
							@foreach($roles as $role)
								<option value="{{ $role->role_id }}" @selected(old('role_id', $user->role_id) == $role->role_id)>
									{{ $role->role_name }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="flex items-center gap-3 md:col-span-2">
						<input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active))>
						<span class="text-sm text-gray-700">Account active</span>
					</div>
				</div>

				<div class="flex gap-3 pt-2">
					<button class="bg-deepOcean text-white px-5 py-2.5 rounded-lg font-semibold">Save Changes</button>
					<a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-lg font-semibold text-deepOcean border border-gray-300 bg-white">Cancel</a>
				</div>
			</form>
		</section>
	</main>
</body>
</html>