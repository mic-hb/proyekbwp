import GeneralLayout from "@/layouts/general";
import { useState, useEffect } from "react";
import api from "@/api";

export default function invoice() {
    return (
        <GeneralLayout>
            <h1 className="text-3xl font-bold flex">INVOICE</h1>
            <div className="flex flex-col w-full gap-4 px-8 py-6 shadow-lg rounded-lg">
                <table className="w-1/3">
                    <tr>
                        <td>Invoice No</td>
                        <td>:</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td>32 February 2150</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>Budi</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>budi@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>:</td>
                        <td>+628181818181</td>
                    </tr>
                </table>
                <table className="w-full justify-center text-center items-center">
                    <thead>
                        <tr>
                            <th className="border border-black">Hotel Code</th>
                            <th className="border border-black">Hotel Name</th>
                            <th className="border border-black">Room Type</th>
                            <th className="border border-black">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td className="border border-black">H001</td>
                            <td className="border border-black">
                                Hotel Enak-Enak
                            </td>
                            <td className="border border-black">
                                Kamar Kedap Suara
                            </td>
                            <td className="border border-black">Rp. 399000</td>
                        </tr>
                    </tbody>
                </table>
                <table className="w-1/4">
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>Rp. 399000</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>:</td>
                        <td>Bank Transfer</td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td>:</td>
                        <td>Paid</td>
                    </tr>
                </table>
            </div>
        </GeneralLayout>
    );
}
