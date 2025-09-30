<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        // Mostrar formulario de contacto
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        try {
            Contact::create($request->only('name', 'email', 'subject', 'message'));
            return back()->with('success', 'Tu mensaje ha sido enviado con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al enviar el mensaje: ' . $e->getMessage());
        }
    }
}
