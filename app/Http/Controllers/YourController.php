public function index()
{
    $recentDonations = \App\Models\Donation::latest()->take(5)->get();
    
    return view('your-view-name', compact('recentDonations'));
}