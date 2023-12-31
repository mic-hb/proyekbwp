import GeneralLayout from "@/layouts/general";
import api from "@/api";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeadCell,
    TableRow,
    Label,
    Select,
} from "flowbite-react";
import { useState, useEffect, useRef } from "react";

export default function admin() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotels, setHotels] = useState([]);
    const [cities, setCities] = useState([]);
    const hotelCodeRef = useRef();
    const hotelNameRef = useRef();
    const hotelAddressRef = useRef();
    const hotelCityRef = useRef();
    const deleteIDRef = useRef();

    ////////////////////////////////////////////////////////

    const clickRow = ({ code, name, address, city_name }) => {
        console.log({
            code,
            name,
            address,
            city_name,
        });

        hotelCodeRef.current.value = code;
        hotelNameRef.current.value = name;
        hotelAddressRef.current.value = address;
        // hotelCityRef.current.value = city_name;
        document.getElementById("selectCity").val = city_name;
    };

    // TODO: useRef di setiap input
    // TODO: kasi onclick di table row
    // TODO: jadi ketika di click, data yang ada di table itu di set ke REF mu

    // TODO: DELETE KASIH CONFIRMATION
    // https://www.flowbite-react.com/docs/components/modal#pop-up-modal

    const handleShowReport = () => {
        const selectedValue = document.getElementById("listReport").value;
        // history.push('/invoice');
        window.location.href = `/admin/invoice/${selectedValue}`;
    };

    ////////////////////////////////////////////////////////
    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelRequest = await api.get("/allHotels", {
                params: {
                    skip: 0,
                    take: 9999,
                },
            });
            const citiesRequest = await api.get("/allCities", {
                params: {
                    skip: 0,
                    take: 9999,
                },
            });
            try {
                const [hotelResponse] = await Promise.all([hotelRequest.data]);
                const [citiesResponse] = await Promise.all([
                    citiesRequest.data,
                ]);
                setHotels(hotelResponse);
                setCities(citiesResponse);
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchData();
    }, []);

    const handleInsert = async () => {
        const csrfToken = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        console.log(csrfToken);
        const insertRequest = await api.post(
            "/admin/proses",
            {
                btnInsert: null,
                // city_code: hotelCityRef.current.value,
                city_code: document.getElementById("selectCity").val,
                code: hotelCodeRef.current.value,
                name: hotelNameRef.current.value,
                address: hotelAddressRef.current.value,
            },
            {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            }
        );
        const insertResponse = insertRequest.data;
        console.log(insertRequest);

        if (insertResponse.status === true) {
            alert(insertResponse.message);
            window.location.href = "/admin";
        }
    };

    const handleUpdate = async () => {
        const csrfToken = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        console.log(csrfToken);
        const updateRequest = await api.post(
            "/admin/proses",
            {
                btnUpdate: null,
                // city_code: hotelCityRef.current.value,
                city_code: document.getElementById("selectCity").val,
                code: hotelCodeRef.current.value,
                name: hotelNameRef.current.value,
                address: hotelAddressRef.current.value,
            },
            {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            }
        );
        const updateResponse = updateRequest.data;

        if (updateResponse.status === true) {
            alert(updateResponse.message);
            window.location.href = "/admin";
        }
    };

    const handleDelete = async (index) => {
        const csrfToken = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        console.log(csrfToken);
        const deleteRequest = await api.post(
            "/admin/delete",
            {
                code: document.getElementById(index).innerHTML,
            },
            {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            }
        );
        const deleteResponse = deleteRequest.data;

        if (deleteResponse.status === true) {
            alert(deleteResponse.message);
            window.location.href = "/admin";
        }
    };

    return (
        <GeneralLayout isLoading={isLoading}>
            <h1 className="text-3xl font-bold">Master Hotel</h1>
            <div
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
                    ref={hotelCodeRef}
                />
                <label htmlFor="">Hotel Name</label>
                <input
                    type="text"
                    name="hotel_name"
                    id="hotel_name"
                    className="rounded-lg px-2 py-1"
                    ref={hotelNameRef}
                />
                <label htmlFor="">Hotel Address</label>
                <input
                    type="text"
                    name="hotel_address"
                    id="hotel_address"
                    className="rounded-lg px-2 py-1"
                    ref={hotelAddressRef}
                />
                <label htmlFor="">Hotel City</label>
                {/* <input
                    type="text"
                    name="hotel_city"
                    id="hotel_city"
                    className="rounded-lg px-2 py-1"
                    ref={hotelCityRef}
                /> */}
                <select name="" id="selectCity">
                    {cities.map((city) => (
                        <option key={city.code} value={city.code}>
                            {city.name}
                        </option>
                    ))}
                </select>
                <div className="flex w-full gap-2">
                    <button
                        onClick={handleInsert}
                        className="px-2 py-1 bg-blue-400 rounded-lg w-1/2"
                    >
                        Insert
                    </button>
                    <button
                        onClick={handleUpdate}
                        className="px-2 py-1 bg-green-400 rounded-lg w-1/2"
                    >
                        Update
                    </button>
                </div>
            </div>

            <div className="py-8">
                <Table hoverable>
                    <TableHead>
                        <TableHeadCell>Code</TableHeadCell>
                        <TableHeadCell>Name</TableHeadCell>
                        <TableHeadCell>Address</TableHeadCell>
                        <TableHeadCell>City</TableHeadCell>
                        <TableHeadCell>Action</TableHeadCell>
                    </TableHead>
                    <TableBody className="divide-y">
                        {/* {hotels.map((hotel) => (
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

                                </td>
                            </tr>
                        ))} */}
                        {hotels.map((hotel, index) => (
                            <TableRow
                                key={hotel.code}
                                onDoubleClick={() => clickRow(hotel)}
                                className="bg-white cursor-pointer dark:border-gray-700 dark:bg-gray-800"
                            >
                                <TableCell
                                    id={index}
                                    className="whitespace-nowrap font-medium text-gray-900 dark:text-white"
                                >
                                    {hotel.code}
                                </TableCell>
                                <TableCell>{hotel.name}</TableCell>
                                <TableCell>{hotel.address}</TableCell>
                                <TableCell>{hotel.city_name}</TableCell>
                                <TableCell>
                                    {hotel.deleted_at === null ? (
                                        <button
                                            onClick={() => handleDelete(index)}
                                            className="px-2 py-1 bg-red-400 rounded-lg w-fit"
                                        >
                                            Delete
                                        </button>
                                    ) : (
                                        <button
                                            onClick={() => handleDelete(index)}
                                            className="px-2 py-1 bg-blue-400 rounded-lg w-fit"
                                        >
                                            Restore
                                        </button>
                                    )}
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </div>
            {/* <table className="w-full justify-center text-center items-center mt-12">
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

                </tbody>
            </table> */}

            <div className="flex flex-col w-full py-8 space-x-10 justify-center">
                <h1 className="text-2xl font-bold">Report Hotel</h1>
                <Select id="listReport" name="report" required>
                    {hotels.map((hotel) => (
                        <option key={hotel.code} value={hotel.code}>
                            {hotel.code} - {hotel.name}
                        </option>
                    ))}
                </Select>
                {/* <select name="report" id="listReport" className="w-1/5 mt-3">
                    <option value="H001">H001</option>
                    <option value="H002">H002</option>
                    <option value="H003">H003</option>
                    <option value="H004">H004</option>
                    <option value="H005">H005</option>
                    <option value="H006">H006</option>
                    <option value="H007">H007</option>
                    <option value="H008">H008</option>
                    <option value="H009">H009</option>
                    <option value="H010">H010</option>
                </select> */}
                <button
                    onClick={handleShowReport}
                    className="px-2 py-1 bg-gradient-to-r from-purple-600 via-indigo-600 to-pink-500 rounded-lg w-1/4 text-white mt-3"
                >
                    Show Report
                </button>
            </div>
        </GeneralLayout>
    );
}
