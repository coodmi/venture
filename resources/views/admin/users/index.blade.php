@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div style="background:#fff;border-radius:.875rem;border:1px solid #e5e7eb;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">

    {{-- Toolbar --}}
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;background:#fafafa;">
        <form method="GET" style="display:flex;gap:.625rem;flex-wrap:wrap;align-items:center;">
            <div style="position:relative;">
                <svg width="14" height="14" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24" style="position:absolute;left:.625rem;top:50%;transform:translateY(-50%);pointer-events:none;"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                       style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem .5rem 2rem;font-size:.875rem;outline:none;width:200px;transition:border-color .15s;"
                       onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
            </div>
            <select name="role" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;cursor:pointer;">
                <option value="">All Roles</option>
                <option value="investor" {{ request('role')==='investor'?'selected':'' }}>Investor</option>
                <option value="seeker"   {{ request('role')==='seeker'?'selected':'' }}>Seeker</option>
                <option value="member"   {{ request('role')==='member'?'selected':'' }}>Member</option>
            </select>
            <select name="status" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;cursor:pointer;">
                <option value="">All Status</option>
                <option value="active"    {{ request('status')==='active'?'selected':'' }}>Active</option>
                <option value="pending"   {{ request('status')==='pending'?'selected':'' }}>Pending</option>
                <option value="suspended" {{ request('status')==='suspended'?'selected':'' }}>Suspended</option>
            </select>
            <button type="submit"
                    style="background:#6366f1;color:#fff;font-size:.875rem;font-weight:600;padding:.5rem 1rem;border-radius:.5rem;border:none;cursor:pointer;display:flex;align-items:center;gap:.375rem;transition:background .15s;"
                    onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                Filter
            </button>
        </form>
    </div>

    {{-- Table --}}
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#f8fafc;">
            <tr>
                @foreach(['Name','Email','Role','Status','Joined','Actions'] as $h)
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom:1px solid #f9fafb;transition:background .1s;"
                onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='transparent';">
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;align-items:center;gap:.625rem;">
                        <div style="width:1.875rem;height:1.875rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span style="color:#fff;font-weight:700;font-size:.65rem;">{{ strtoupper(substr($user->name,0,1)) }}</span>
                        </div>
                        <span style="font-weight:600;color:#111827;">{{ $user->name }}</span>
                    </div>
                </td>
                <td style="padding:.75rem 1rem;color:#6b7280;">{{ $user->email }}</td>
                <td style="padding:.75rem 1rem;">
                    @foreach($user->roles as $role)
                    <span style="background:#eef2ff;color:#4338ca;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td style="padding:.75rem 1rem;">
                    <span style="font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;
                        {{ $user->status==='active'?'background:#ecfdf5;color:#059669;':($user->status==='suspended'?'background:#fef2f2;color:#dc2626;':'background:#fff7ed;color:#d97706;') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td style="padding:.75rem 1rem;color:#9ca3af;font-size:.8125rem;">{{ $user->created_at->format('M d, Y') }}</td>
                <td style="padding:.75rem 1rem;">
                    <a href="{{ route('admin.users.show',$user) }}"
                       style="display:inline-flex;align-items:center;gap:.25rem;color:#6366f1;text-decoration:none;font-size:.8125rem;font-weight:600;padding:.25rem .625rem;background:#eef2ff;border-radius:.375rem;transition:background .15s;"
                       onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">
                        View
                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">{{ $users->links() }}</div>
</div>
@endsection
