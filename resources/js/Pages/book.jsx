import { useState, useEffect, useRef } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import { usePage } from "@inertiajs/react";

export default function book() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotel, setHotel] = useState({});
    const [bookingData, setBookingData] = useState({});
    const [user, setUser] = useState({});
    const startDateRef = useRef();
    const endDateRef = useRef();

    const handleBooking = async () => {
        setIsLoading(true);

        try {
            const bookingRequest = await api.post("/bookings/confirm", {
                user_id: user.id,
                hotel_code: hotel.code,
                room_code: bookingData.roomCode,
                room_type_code: bookingData.roomTypeCode,
                lowest_price: bookingData.lowestPrice,
                start_date: startDateRef.current.value,
                end_date: endDateRef.current.value,
            });
            const [bookingResponse] = await Promise.all([bookingRequest.data]);

            if (bookingResponse.status === true) alert(bookingResponse.message);
            else alert(bookingResponse.message);

            window.location.href = "/";
        } catch (error) {
            console.log(error);
        } finally {
            setIsLoading(false);
        }
    };

    const cancelBooking = async () => {
        setIsLoading(true);

        try {
            const bookingRequest = await api.get("/bookings/cancel");
            const [bookingResponse] = await Promise.all([bookingRequest.data]);

            if (bookingResponse.status === true) alert(bookingResponse.message);
            else alert(bookingResponse.message);

            window.location.href = "/";
        } catch (error) {
            console.log(error);
        } finally {
            setIsLoading(false);
        }
    };

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const userDataRequest = await api.get("/checkLogin");
            const bookingDataRequest = await api.get("/bookings/data");

            try {
                const [userDataResponse] = await Promise.all([
                    userDataRequest.data,
                ]);
                const [bookingDataResponse] = await Promise.all([
                    bookingDataRequest.data,
                ]);

                if (userDataResponse.status === true) {
                    setUser(userDataResponse.user);
                }
                if (bookingDataResponse.status === true) {
                    setBookingData(bookingDataResponse.data);
                }

                console.log(userDataResponse);
                console.log(bookingDataResponse);

                const hotelDetailRequest = await api.get(
                    `/hotel/${bookingDataResponse.data.hotelCode}`
                );
                const [hotelResponse] = await Promise.all([
                    hotelDetailRequest.data,
                ]);
                setHotel(hotelResponse[0]);
                console.log(hotelDetailRequest);

                // hotelResponse[0].image_urls.map((image) => {
                //     image_urls.push(image);
                // });
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchData();
    }, [setUser]);

    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="w-full flex">
                <h1 className="text-2xl font-bold">Confirm Your Booking</h1>
            </div>
            <div className="w-full flex flex-col shadow-lg rounded-lg px-4 py-3 gap-2">
                <label htmlFor="">Name</label>
                <input
                    type="text"
                    className="rounded-lg"
                    value={user.name}
                    disabled
                />
                <label htmlFor="">Email</label>
                <input
                    type="email"
                    className="rounded-lg"
                    value={user.email}
                    disabled
                />
                <label htmlFor="">Phone Number</label>
                <input
                    type="tel"
                    className="rounded-lg"
                    value={user.phone}
                    disabled
                />
                <hr />
                <br />
                <div className="flex space-x-5 align-center font-medium text-xl">
                    <div htmlFor="">Hotel : </div>
                    <div className="">{hotel.name}</div>
                </div>
                <div className="flex space-x-5 align-center font-medium text-xl">
                    <div htmlFor="">Room Type : </div>
                    <div className="">{bookingData.roomTypeCode}</div>
                </div>
                <div className="flex space-x-5 align-center font-medium text-xl">
                    <span htmlFor="">Start Date :</span>
                    <input
                        type="date"
                        className="rounded-lg"
                        ref={startDateRef}
                    />
                </div>
                <div className="flex space-x-5 align-center font-medium text-xl">
                    <span htmlFor="">End Date :</span>
                    <input
                        type="date"
                        className="rounded-lg"
                        ref={endDateRef}
                    />
                </div>

                <h1 className="text-2xl font-semibold">
                    Total: Rp {bookingData.lowestPrice}
                </h1>
                <button
                    onClick={handleBooking}
                    className="w-fit px-2 py-1 bg-blue-400 rounded-lg"
                >
                    Pay Now
                </button>
                <button
                    onClick={cancelBooking}
                    className="w-fit px-2 py-1 bg-red-400 rounded-lg"
                >
                    Cancel
                </button>
            </div>
        </GeneralLayout>
    );
}
