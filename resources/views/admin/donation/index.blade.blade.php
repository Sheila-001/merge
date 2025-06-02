                        <td class="py-2">
                            @if($donation->proof_path)
                                <img src="{{ Storage::url($donation->proof_path) }}" alt="Donation Proof" class="w-10 h-10 object-cover rounded">
                            @else
                                N/A
                            @endif
                        </td> 