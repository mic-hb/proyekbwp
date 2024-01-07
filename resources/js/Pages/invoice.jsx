import GeneralLayout from "@/layouts/general";
import { useState, useEffect } from "react";
import api from "@/api";
import { usePage } from "@inertiajs/react";
export default function invoice() {
    const hotelCode = usePage().props.id;
    const [hotel, setHotel] = useState("");
    const [isLoading, setIsLoading] = useState(true);
    const [dataHtrans, setDataHtrans] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            try {
                const hotelDetailsRequest = await api.get(
                    `/hotel/${hotelCode}`
                );
                const [hotelResponse] = await Promise.all([
                    hotelDetailsRequest.data,
                ]);
                setHotel(hotelResponse[0]);
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchData();
    },[]);

    return (
        <GeneralLayout isLoading={isLoading}>
            <h1 className="text-3xl font-bold flex">
                REPORT HOTEL {hotel.name}
            </h1>
            <div className="flex flex-col w-full gap-4 px-8 py-6 shadow-lg rounded-lg">
                <table className="w-2/3">
                    <tr>
                        <td>Hotel Code</td>
                        <td>:</td>
                        <td>{hotel.code}</td>
                    </tr>
                    <tr>
                        <td>Hotel Name</td>
                        <td>:</td>
                        <td>{hotel.name}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td>{hotel.city_name}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>
                            {hotel.address}
                        </td>
                    </tr>
                    <tr>
                        <td>Number Of Transactions</td>
                        <td>:</td>
                        <td>{dataHtrans.length}</td>
                    </tr>
                </table>
            </div>

            <h1 className="text-3xl font-bold flex justify-center mt-5">
                INVOICE
            </h1>
            <div className="flex flex-col w-full gap-4 px-8 py-6 shadow-lg rounded-lg bg-slate-400 mt-5">
                <div className="flex flex-col w-full gap-4 px-8 py-6 shadow-lg rounded-lg bg-white">
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
                                <th className="border border-black">
                                    Hotel Code
                                </th>
                                <th className="border border-black">
                                    Hotel Name
                                </th>
                                <th className="border border-black">
                                    Room Type
                                </th>
                                <th className="border border-black">
                                    Subtotal
                                </th>
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
                                <td className="border border-black">
                                    Rp. 399000
                                </td>
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
                <div className="flex flex-col w-full gap-4 px-8 py-6 shadow-lg rounded-lg bg-white">
                    <table className="w-1/3">
                        <tr>
                            <td>Invoice No</td>
                            <td>:</td>
                            <td>2</td>
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
                                <th className="border border-black">
                                    Hotel Code
                                </th>
                                <th className="border border-black">
                                    Hotel Name
                                </th>
                                <th className="border border-black">
                                    Room Type
                                </th>
                                <th className="border border-black">
                                    Subtotal
                                </th>
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
                                <td className="border border-black">
                                    Rp. 399000
                                </td>
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
            </div>
        </GeneralLayout>
    );
}
