<x-guest-layout>
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">JOB</h3>
    </div>
    <div class="bg-white">
        <div class="space-y-10 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32 ">
    <table style="width: 100% ;  border-collapse: collapse;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">Name</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Description</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Job Skill</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Job ROle</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Job Type</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Location</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Salary</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $user)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->description }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->skill ? $user->skill->name:"-" }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->role ? $user->role->name:"-" }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->type ? $user->type->name:"-" }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->location ? $user->location->name:"-" }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->salary }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
    </div>

</x-guest-layout>
