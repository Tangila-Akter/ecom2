<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('admin.pages.invoice.index', compact('invoices'));
    }


    // generate invoice
    public function createInvoice($id)
    {
        $invoice = Invoice::with('shop', 'products')->where('id', $id)->first();
        return view('admin.pages.invoice.invoice', compact('invoice'));
    }
}
