/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function CheckOrder()
{ 
                var HatID = document.OrderForm.HatID.value;
                var QuantityOrdered = document.OrderForm.QuantityField.value;
                var FirstName = document.OrderForm.FirstNameField.value;
                var LastName = document.OrderForm.LastNameField.value;
                var PhoneNumber = document.OrderForm.PhoneNumberField.value;
                var ShippingAddress = document.OrderForm.ShippingAddressField.value;
                var City = document.OrderForm.CityField.value;
                var State = document.OrderForm.StateField.value;
                var ZipCode = document.OrderForm.ZipCodeField.value;
                var CCNumber = document.OrderForm.CreditCardNumberField.value;
                var CCName = document.OrderForm.CreditCardNameField.value;
                var ExpMonth = document.OrderForm.ExpMonthField.value;
                var ExpYear = document.OrderForm.ExpYearField.value;
                var ShippingMethod = '';
                
        
                for (i=0; i<document.OrderForm.Shipping.length; i++) 
                {
                    if (document.OrderForm.Shipping[i].checked == true)
                    {
                        ShippingMethod = document.OrderForm.Shipping[i].value;
                    }
                }
                
                if (!/^\d{4}$/.test(PhoneNumber))
                {
                    alert ("Quantity must be a positive nonzero integer.");
                    return false;
                }
                else if (!/^[A-z]+$/.test(FirstName))
                {
                    alert ("No numbers allowed in First Name field");
                    return false;
                }
                else if (!/^[A-z]+$/.test(LastName))
                {
                    alert ("No numbers allowed in Last Name field");
                    return false;
                }
                else if(!/^\d{10}$/.test(PhoneNumber))
                {
                    alert ("Phone number must be 10 digits long. Example: 1234567890");
                    return false;
                }
                else if(!/^[A-z]+$/.test(City))
                {
                    alert ("Non-alphabetic characters not allowed in City field");
                    return false;
                }
                else if(!/^[A-z]+$/.test(State))
                {
                    alert ("Non-alphabetic characters not allowed in State field");
                    return false;
                }
                else if(!/^\d{5}$/.test(ZipCode))
                {
                    alert ("Zip Code must contain only numbers");
                    return false;
                }
                else if(!/^\d{16}$/.test(CCNumber))
                {
                    alert ("Credit Card number must contain only numbers");
                    return false;
                }
                else if(!/^[A-z]+$/.test(CCName))
                {
                    alert ("Non-alphabetic characters not allowed in Credit Card Name field");
                    return false;
                }
                else
                {
                    var email = "yukiw@uci.edu";
                    window.open("mailto:" + email + "?subject=Order: " + HatID + "&body=Order Summary:%0D%0AHatID:" + HatID + "%0D%0AQuantity Ordered:" + QuantityOrdered + "%0D%0AName: " + FirstName + " " + LastName + "%0D%0APhoneNumber: " + PhoneNumber + "%0D%0AAddress: " + ShippingAddress + "%0D%0ACity: " + City + "%0AState: " + State + "%0AZIP: " + ZipCode + "%0ACard Number: " + CCNumber + "%0D%0AName on card: " + CCName + "%0D%0AExpiration Date: " + ExpMonth + "/" + ExpYear+ "%0D%0AShipping Method: " + ShippingMethod);
    
                    return true;
                    //window.open("mailto:" + email + "?subject=Order: " + HatID + "&body=Order Summary:%0D%0AHatID:" + HatID + "%0D%0AQuantity Ordered:" + QuantityOrdered + "%0D%0AName: " + FirstName + " " + LastName + "%0D%0APhoneNumber: " + PhoneNumber + "%0D%0AAddress: " + ShippingAddress + "%0D%0ACity: " + City + "%0AState: " + State + "%0AZIP: " + ZipCode + "%0ACard Number: " + CCNumber + "%0D%0AName on card: " + CCName + "%0D%0AExpiration Date: " + ExpMonth + "/" + ExpYear+ "%0D%0AShipping Method: " + ShippingMethod);
                }
                // Format looks OK, form can be submitted.
            }
        //-->