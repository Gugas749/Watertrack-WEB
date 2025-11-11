package com.grupok.watertrack.fragments.mainactivityfrags.addreportview;

import android.content.Context;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.databinding.FragmentMainACDetailsContadorBinding;
import com.grupok.watertrack.databinding.FragmentMainACReportBinding;
import com.grupok.watertrack.fragments.mainactivityfrags.detailscontadorview.MainACDetailsContadorFrag;

import java.util.ArrayList;
import java.util.List;


public class MainACReportFrag extends Fragment {


    private MainActivity parent;
    private FragmentMainACReportBinding binding;
    private MainACReportFrag THIS;

    private List<ContadorEntity> contadoresEntityList;
    private List<String> listString = new ArrayList<>();

    private Context context;
    private String[] problemas;


    public MainACReportFrag() {
        // Required empty public constructor
    }


    public MainACReportFrag(MainActivity parent, List<ContadorEntity> contadoresEntityList) {
        this.parent = parent;
        this.contadoresEntityList = contadoresEntityList;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentMainACReportBinding.inflate(inflater, container, false);

        if(parent != null && parent.currentUserInfo != null){
            init();
        }

        return binding.getRoot();
    }
    private void init(){

        THIS = this;
        context = getContext();


        listString.add("Problema 1");
        listString.add("Problema 2");
        listString.add("Problema 3");
        listString.add("Outro problema");
        fillProblem(listString);

    }
    private void fillProblem(List<String> list) {


        ArrayAdapter<String> adapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                list
        );

        binding.comboBoxProblemReportFragMainAc.setAdapter(adapter);

    }

}