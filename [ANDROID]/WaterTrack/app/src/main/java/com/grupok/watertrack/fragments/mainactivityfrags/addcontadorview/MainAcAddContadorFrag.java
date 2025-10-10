package com.grupok.watertrack.fragments.mainactivityfrags.addcontadorview;

import android.os.AsyncTask;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.room.Room;

import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.database.LocalDataBase;
import com.grupok.watertrack.database.daos.UserInfosDao;
import com.grupok.watertrack.database.entities.UserInfosEntity;
import com.grupok.watertrack.databinding.FragmentMainAcAddContadorBinding;

import java.util.ArrayList;
import java.util.List;

public class MainAcAddContadorFrag extends Fragment {

    private FragmentMainAcAddContadorBinding binding;
    private MainActivity parent;
    private UserInfosDao userInfosDao;
    private LocalDataBase localDataBase;
    private List<String> listString = new ArrayList<>();

    public MainAcAddContadorFrag() {
        // Required empty public constructor
    }
    public MainAcAddContadorFrag(MainActivity parent) {
        this.parent = parent;
    }


    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentMainAcAddContadorBinding.inflate(inflater);

        if(parent.currentUserInfo != null){
            init();
        }

        return binding.getRoot();
    }
    private void init(){
        disableBackPressed();
        setupLocalDataBase();
        new LocalDatabaseUpdateTask().execute();
        fillDropdownMenu(listString);
        validateInsertionDropdownMenu();
    }
    //---------------------------SETUPS---------------------------
    private void setupLocalDataBase(){
        localDataBase = Room.databaseBuilder(getContext(), LocalDataBase.class, "WaterTrackLocalDB").build();
        userInfosDao = localDataBase.userInfosDao();
    }
    //---------------------------DROPDOWN RELATED---------------------------
    private void fillDropdownMenu(List<String> list) {
        ArrayAdapter<String> adapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                list
        );

        binding.autoCompleteResidentsAddContadorFragMainAc.setAdapter(adapter);

        // CODIGO PARA QUANDO CLICAR O ICON NO FIM DO INPUT ABRIR A DROPDOWN DIRETO
        binding.textInputLayoutComboBoxResidentsAddContadorFragMainAc.setEndIconOnClickListener(v -> binding.autoCompleteResidentsAddContadorFragMainAc.showDropDown());
        binding.autoCompleteResidentsAddContadorFragMainAc.setOnClickListener(v -> binding.autoCompleteResidentsAddContadorFragMainAc.showDropDown());
    }
    private void validateInsertionDropdownMenu() {
        binding.autoCompleteResidentsAddContadorFragMainAc.setOnItemClickListener((parent, view, position, id) -> {
            String selected = (String) parent.getItemAtPosition(position);
            Toast.makeText(getContext(), ""+selected, Toast.LENGTH_SHORT).show();
        });
    }
    //---------------------------FUNCTIONS---------------------------
    private void disableBackPressed(){
        binding.getRoot().setFocusableInTouchMode(true);
        binding.getRoot().requestFocus();
        binding.getRoot().setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View v, int keyCode, KeyEvent event) {
                if (keyCode == KeyEvent.KEYCODE_BACK && event.getAction() == KeyEvent.ACTION_UP) {
                    return true;
                }
                return false;
            }
        });
    }
    private class LocalDatabaseUpdateTask extends AsyncTask<Void, Void, List<String>> {
        @Override
        protected List<String> doInBackground(Void... voids) {
            List<UserInfosEntity> userList = userInfosDao.getUserInfos();
            for (UserInfosEntity user : userList){
                listString.add(""+user.id+" - "+user.nome);
            }

            return listString;
        }

        @Override
        protected void onPostExecute(List<String> objects) {

        }
    }
}