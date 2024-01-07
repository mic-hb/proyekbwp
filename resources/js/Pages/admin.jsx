import GeneralLayout from "@/layouts/general";
import api from "@/api";
import { useState, useEffect } from "react";

export default function admin() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotels, setHotels] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelRequest = await api.get("/allHotels", {
                params: {
                    skip: 0,
                    take: 10,
                },
            });
            const hotelDetailsRequest = await api.get("/hotel/H001");

            try {
                const [hotelResponse] = await Promise.all([hotelRequest.data]);
                setHotels(hotelResponse);
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchData();
    }, []);
    return (
        <GeneralLayout isLoading={isLoading}>
            <h1 className="text-2xl font-bold">Master Hotel</h1>
            <form
                action="#"
                method="post"
                className="flex flex-col w-full gap-2 shadow-lg px-8 py-6 rounded-lg"
            >
                <label htmlFor="">Hotel Code</label>
                <input
                    type="text"
                    name="hotel_code"
                    id="hotel_code"
                    className="rounded-lg px-2 py-1"
                />
                <label htmlFor="">Hotel Name</label>
                <input
                    type="text"
                    name="hotel_name"
                    id="hotel_name"
                    className="rounded-lg px-2 py-1"
                />
                <label htmlFor="">Hotel Address</label>
                <input
                    type="text"
                    name="hotel_address"
                    id="hotel_address"
                    className="rounded-lg px-2 py-1"
                />
                <label htmlFor="">Hotel City</label>
                <input
                    type="text"
                    name="hotel_city"
                    id="hotel_city"
                    className="rounded-lg px-2 py-1"
                />
                <div className="flex w-full gap-2">
                    <button
                        type="submit"
                        className="px-2 py-1 bg-blue-400 rounded-lg w-1/2"
                    >
                        Insert
                    </button>
                    <button
                        type="submit"
                        className="px-2 py-1 bg-green-400 rounded-lg w-1/2"
                    >
                        Update
                    </button>
                </div>
            </form>
            <table className="w-full justify-center text-center items-center mt-12">
                <thead>
                    <tr>
                        <th className="border border-black px-2 py-1">Code</th>
                        <th className="border border-black px-2 py-1">Name</th>
                        <th className="border border-black px-2 py-1">
                            Address
                        </th>
                        <th className="border border-black px-2 py-1">City</th>
                        <th className="border border-black px-2 py-1">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {hotels.map((hotel) => (
                        <tr>
                            <td className="border border-black px-2 py-1">
                                {hotel.code}
                            </td>
                            <td className="border border-black px-2 py-1">
                                {hotel.name}
                            </td>
                            <td className="border border-black px-2 py-1">
                                {hotel.address}
                            </td>
                            <td className="border border-black px-2 py-1">
                                {hotel.city_name}
                            </td>
                            <td className="border border-black px-2 py-1">
                                <button
                                    type="submit"
                                    className="px-2 py-1 bg-red-400 rounded-lg w-fit"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <div className="flex w-full space-x-10 justify-center">
                <h1 className="text-2xl font-bold mt-5">Report Hotel</h1>
                <select name="report" id="listReport" className="w-1/5 mt-3">
                    <option value="H001">H001</option>
                    <option value="H002">H002</option>
                    <option value="H003">H003</option>
                    <option value="H004">H004</option>
                    <option value="H005">H005</option>
                    <option value="H006">H006</option>
                    <option value="H007">H007</option>
                    <option value="H008">H008</option>
                    <option value="H009">H009</option>
                    <option value="H0010">H0010</option>
                </select>
                <button className="px-2 py-1 bg-gradient-to-r from-purple-600 via-indigo-600 to-pink-500 rounded-lg w-1/4 text-white mt-3">Show Report</button>
            </div>
        </GeneralLayout>
    );
}
